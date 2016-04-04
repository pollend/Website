<?php

namespace PN\Assets\Http\Controllers;


use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Assets\Repositories\Criteria\TypeCriteria;
use PN\Assets\Tag;
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

        return view('assets.show', compact(
            'asset'
        ));
    }

    public function filter($type)
    {
        $assets = $this->assetRepo->filter($type, \Request::input('name', ''), \Request::input('stats', []), \Request::input('tags', []), \Request::input('sort'));
        $assets->appends(\Request::all());

        $filters = config('assetfilters.'.$type, []);

        $tags = Tag::where('type', $type)
            ->where('primary', 1)
            ->orderBy('tag')
            ->get();

        return view('assets.filter', compact(
            'assets',
            'filters',
            'tags',
            'type'
        ));
    }
}
