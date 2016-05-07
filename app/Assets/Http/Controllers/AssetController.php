<?php

namespace PN\Assets\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Support\Collection;
use PN\Assets\AssetFilter;
use PN\Assets\Events\UserDownloadedAsset;
use PN\Assets\Exceptions\AssetCantBeDownloadedException;
use PN\Assets\Events\UserViewingAsset;
use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Foundation\Http\Controllers\Controller;
use PN\Foundation\StorageUtil;

class AssetController extends Controller
{
    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepo;

    /**
     * AssetController constructor.
     * @param $assetRepo
     */
    public function __construct(AssetRepositoryInterface $assetRepo)
    {
        $this->assetRepo = $assetRepo;
    }

    public function getShow($identifier, $slug)
    {
        $asset = $this->assetRepo->findByIdentifier($identifier);

        abort_if($asset == null, 404);

        $comments = \CommentRepo::forAsset($asset);
        
        event(new UserViewingAsset($asset, \Auth::user()));

        return view('assets.show', compact(
            'asset',
            'comments'
        ));
    }

    private function getStats() : Collection
    {
        $stats = new Collection();
        
        foreach (\Request::input('stats', []) as $slug => $value) {
            $stat = \StatRepo::findBySlug($slug);

            if($stat == null) dd($slug);
            $stats->put($stat->id, $value);
        }

        return $stats;
    }

    private function getOnTags() : Collection
    {
        $onTags = Collection::make(\Request::input('tags'))->filter(function ($state) {
            return $state == 'on';
        });

        if(!$onTags->count()) {
            return new Collection();
        }

        return \TagRepo::findBySlugs(array_keys($onTags->toArray()));
    }

    private function getOffTags() : Collection
    {
        $offTags = Collection::make(\Request::input('tags'))->filter(function ($state) {
            return $state == 'off';
        });

        if(!$offTags->count()) {
            return new Collection();
        }

        return \TagRepo::findBySlugs(array_keys($offTags->toArray()));
    }

    private function getMaxAge() : Carbon
    {
        if(\Request::has('range')) {
            if(\Request::input('range') == 'week') {
                return Carbon::now()->subWeek();
            }
            if(\Request::input('range') == 'month') {
                return Carbon::now()->subMonth();
            }
        }

        return Carbon::now()->subYears(10);
    }

    public function filterPage($type)
    {
        $filters = config('assetfilters.' . $type, []);

        $tags = \TagRepo::findPrimary($type);

        if(count($tags) == 0) {
            $tags = \TagRepo::findSecondary($type);
        }

        $assetList = $this->filterAssets($type)->render();

        return view('assets.filter', compact(
            'assetList',
            'filters',
            'tags',
            'type'
        ));
    }

    public function filterAssets($type)
    {
        // todo hotfix
        if(!\Request::has('sort')){
            \Request::replace(array_merge(\Request::all(), ['sort' => 'hot_score']));
        }

        $assetFilter = (new AssetFilter())
            ->withType($type)
            ->withNameLike(\Request::input('name', ''))
            ->withTags($this->getOnTags())
            ->withoutTags($this->getOffTags())
            ->withStats($this->getStats())
            ->withMaxAge($this->getMaxAge())
            ->sortBy(request('sort', 'hot_score'));

        $assets = $assetFilter->filterPaginated();

        $assets->setPath(route('assets.filter', [$type]));
        $assets->appends(\Request::all());

        return view('assets.partials.list', compact(
            'assets',
            'type'
        ));
    }

    public function download($identifier)
    {
        $asset = \AssetRepo::findByIdentifier($identifier);

        event(new UserDownloadedAsset($asset, \Auth::user()));

        $extension = pathinfo($asset->getResource()->source, PATHINFO_EXTENSION);

        if ($asset->type == 'blueprint') {
            $tempPath = StorageUtil::copyToTmp('blueprints', $asset->getResource()->source);

            $arguments = escapeshellarg(base_path('bin/ParkitectNexus.AssetTools.exe')) . " blueprint-convert " .
                "--input " . \ResourceUtil::escapeArgument($tempPath) . " " .
                "--background " . \ResourceUtil::escapeArgument(base_path('bin/blueprint_bg.png')) . " " .
                "--logo " . \ResourceUtil::escapeArgument(base_path('bin/logo.png')) . " " .
                "--font " . \ResourceUtil::escapeArgument(base_path('bin/Roboto-Regular.ttf')) . " " .
                "--draw-text " .
                \ResourceUtil::escapeArgument("175,450,#ffffffff,12 {$asset->name}") . " " .
                \ResourceUtil::escapeArgument("175,465,#ffffffff,12 By {$asset->getUser()->getPresenter()->displayName()}") . " " .
                \ResourceUtil::escapeArgument("175,480,#ffffffff,12 Downloaded from ParkitectNexus.com");

            $result = shell_exec("PATH=\$PATH:/usr/local/bin; mono $arguments 2>&1");

            return response(base64_decode($result))
                ->header('Content-Type', 'image/png')
                ->header('Content-Disposition', "attachment; filename=\"{$asset->slug}.$extension\"");
        } else if ($asset->type == 'park') {
            $tempPath = StorageUtil::copyToTmp('parks', $asset->getResource()->source);

            return \Response::download($tempPath, $asset->slug . '.' . $extension);
        } else {
            throw new AssetCantBeDownloadedException(sprintf("Asset identifier: %s", $identifier));
        }
    }
}
