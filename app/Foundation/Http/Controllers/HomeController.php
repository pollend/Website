<?php

namespace PN\Foundation\Http\Controllers;


use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Assets\Stats\Blueprint;

class HomeController extends Controller
{
    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepo;

    /**
     * Controller constructor.
     * @param AssetRepositoryInterface $assetRepo
     */
    public function __construct(AssetRepositoryInterface $assetRepo)
    {
        $this->assetRepo = $assetRepo;
    }

    /**
     *
     */
    public function getIndex()
    {
        return view('home.index');
    }
}
