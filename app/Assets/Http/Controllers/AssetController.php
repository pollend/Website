<?php

namespace PN\Assets\Http\Controllers;


use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Foundation\Http\Controllers\Controller;

class AssetController extends Controller
{
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

        return view('assets.show', compact([
            'asset'
        ]));
    }
}
