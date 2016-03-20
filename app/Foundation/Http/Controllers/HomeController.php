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
        $popular = $this->assetRepo->mostPopular(4);
        $newest = $this->assetRepo->newest(4);

        return view('home.index', compact('popular', 'newest'));
    }
}
