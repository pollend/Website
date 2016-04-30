<?php

namespace PN\Assets\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Support\Collection;
use PN\Assets\AssetFilter;
use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Foundation\Http\Controllers\Controller;

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
        $comments = \CommentRepo::forAsset($asset);

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
        if(\Request::has('age')) {
            if(\Request::input('age') == 'week') {
                return Carbon::now()->subWeek();
            }
            if(\Request::input('age') == 'month') {
                return Carbon::now()->subMonth();
            }
        }

        return Carbon::now()->subYears(10);
    }

    public function filterPage($type)
    {
        $filters = config('assetfilters.' . $type, []);

        $tags = \TagRepo::findPrimary($type);

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
        $assetFilter = (new AssetFilter())
            ->withType($type)
            ->withNameLike(\Request::input('name', ''))
            ->withTags($this->getOnTags())
            ->withoutTags($this->getOffTags())
            ->withStats($this->getStats())
            ->withMaxAge($this->getMaxAge())
            ->sortBy(\Request::input('sort'));

        $assets = $assetFilter->filterPaginated();

        $assets->setPath(route('assets.filter', [$type]));
        $assets->appends(\Request::all());

        return view('assets.partials.list', compact(
            'assets',
            'type'
        ));

    }
}
