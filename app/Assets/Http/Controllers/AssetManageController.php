<?php

namespace PN\Assets\Http\Controllers;


use Illuminate\Support\Collection;
use PN\Assets\Http\Requests\CreateRequest;
use PN\Assets\Http\Requests\SelectFileRequest;
use PN\Assets\Jobs\CreateAsset;
use PN\Assets\Jobs\CreateStats;
use PN\Assets\Jobs\SetAssetImage;
use PN\Assets\Jobs\SetPrimaryTags;
use PN\Assets\Jobs\SetYoutubeOnAsset;
use PN\Assets\Jobs\Tags\AttachTagToAsset;
use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Assets\Repositories\TagRepositoryInterface;
use PN\BuildOffs\Repositories\BuildOffRepositoryInterface;
use PN\Foundation\Http\Controllers\Controller;
use PN\Resources\Jobs\SetAlbumImages;

class AssetManageController extends Controller
{
    private $assetRepo;

    /**
     * @var BuildOffRepositoryInterface
     */
    private $buildOffRepo;

    /**
     * @var
     */
    private $tagRepo;

    /**
     * AssetManageController constructor.
     * @param $assetRepo
     */
    public function __construct(
        AssetRepositoryInterface $assetRepo,
        BuildOffRepositoryInterface $buildOffRepo,
        TagRepositoryInterface $tagRepo
    ) {
        $this->assetRepo = $assetRepo;
        $this->buildOffRepo = $buildOffRepo;
        $this->tagRepo = $tagRepo;
    }

    public function getSelectFile()
    {
        return \View::make('assets/manage/select-file');
    }

    public function postSelectFile(SelectFileRequest $request)
    {
        try {
            $resource = \ResourceUtil::make('resource');
        } catch (\Exception $e) {
            return \Redirect::back()->withErrors($e);
        }

        \Session::set('resource', $resource);

        return \Redirect::route('assets.manage.create');
    }

    public function getCreate()
    {
        $resource = \Session::get('resource');

        $mods = [];
        $buildOffs = $this->buildOffRepo->all();
        $primaryTags = $this->tagRepo->findByPrimaryTags($resource->getPrimaryTags()->toArray());
        $secondaryTags = $this->tagRepo->findSecondary($resource->getType());
        $type = $resource->getType();

        if ($resource == null) {
            throw new SessionExpired();
        }

        return \View::make('assets.manage.create', compact(
            'name',
            'resource',
            'type',
            'buildOffs',
            'primaryTags',
            'secondaryTags',
            'mods'
        ));
    }

    public function postCreate(CreateRequest $request)
    {
        $resource = \Session::get('resource');
        $resource->save();

        $asset = $this->dispatch(app(CreateAsset::class, [
            $resource,
            \Auth::user(),
            \Request::get('name'),
            \Request::get('description')
        ]));

        if(\Request::get('youtube', '') != '') {
            $this->dispatch(app(SetYoutubeOnAsset::class, [$asset, \Request::get('youtube')]));
        }

        if(\Request::hasFile('image')) {
            $this->dispatch(app(SetAssetImage::class, [$asset, file_get_contents(\Request::file('image')->getRealPath())]));
        }

        if(\Request::hasFile('album')) {
            $images = new Collection();

            foreach(\Request::file('album') as $image) {
                $images->push(file_get_contents($image->getRealPath()));
            }

            $this->dispatch(app(SetAlbumImages::class, [$asset->album, $images]));
        }

        $this->dispatch(app(CreateStats::class, [$asset]));

        $this->dispatch(app(SetPrimaryTags::class, [$asset]));

        foreach (\Request::get('tags', []) as $tagId => $state) {
            $tag = $this->tagRepo->find($tagId);

            $this->dispatch(app(AttachTagToAsset::class, [$asset, $tag]));
        }

        \Session::remove('resource');

        return redirect(route('assets.show', [$asset->identifier, $asset->slug]));
    }

    public function getUpdate($identifier)
    {

    }

    public function postUpdate($identifier)
    {

    }
}
