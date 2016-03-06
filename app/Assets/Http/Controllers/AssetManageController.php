<?php

namespace PN\Assets\Http\Controllers;


use PN\Assets\Asset;
use PN\Assets\Http\Requests\CreateRequest;
use PN\Assets\Http\Requests\SelectFileRequest;
use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Assets\Repositories\TagRepositoryInterface;
use PN\Assets\SessionExpired;
use PN\Assets\Stats\Blueprint;
use PN\BuildOffs\Repositories\BuildOffRepositoryInterface;
use PN\Foundation\Http\Controllers\Controller;
use PN\Resources\Album;
use PN\Resources\Image;

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
        $primaryTags = $this->tagRepo->findPrimary();
        $secondaryTags = $this->tagRepo->findSecondary();
        $type = $resource->getType();

        if ($resource == null) {
            throw new SessionExpired();
        }

        return \View::make('assets.manage.create', compact([
            'resource',
            'type',
            'buildOffs',
            'primaryTags',
            'secondaryTags',
            'mods'
        ]));
    }

    public function postCreate(CreateRequest $request)
    {
        $resource = \Session::get('resource');
        $asset = new Asset();
        $image = Image::make($resource->image->getRaw());
        $album = new Album();

        $image->save();
        $album->save();
        $resource->image->save();
        $resource->save();

        $asset->setUser(\Auth::user());
        $asset->name = \Request::get('name');
        $asset->description = \Request::get('description');

        // set relations
        $asset->setResource($resource);
        $asset->setImage($image);
        $asset->setAlbum($album);

        $asset->save();

        \Session::remove('resource');

        return redirect(route('assets.show', [$asset->identifier, $asset->slug]));
    }
}
