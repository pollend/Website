<?php


namespace PN\BuildOffs\Http\Controllers;


use PN\Foundation\Http\Controllers\Controller;

class BuildOffController extends Controller
{
    public function index()
    {
        $buildOffs = \BuildOffRepo::descended();
        
        $buildOffPage = \PageRepo::find('buildoffs');

        return view('buildoffs.index', compact('buildOffs', 'buildOffPage'));
    }

    public function show($id, $slug)
    {
        $buildOff = \BuildOffRepo::find($id);

        if($buildOff->isOpen()) {
            // random sort
            $assets = \AssetRepo::forBuildOff($buildOff)->sort(function($a, $b){
                return rand(0, 1);
            });
        } else {
            // get assets in rank order
            $assets = $buildOff->getRanks()->map(function($item){
                return $item->getAsset();
            });
        }

        return view('buildoffs.show', compact('buildOff', 'assets'));
    }
}