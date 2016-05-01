<?php


namespace PN\Assets;


class AssetCountService
{
    public function getBlueprintCount()
    {
        return \Cache::remember('asset.blueprintcount', rand(3000, 4000), function(){
            return \AssetRepo::countByType('blueprint');
        });
    }

    public function getModCount()
    {
        return \Cache::remember('asset.parkcount', rand(3000, 4000), function(){
            return \AssetRepo::countByType('mod');
        });
    }

    public function getParkCount()
    {
        return \Cache::remember('asset.modcount', rand(3000, 4000), function(){
            return \AssetRepo::countByType('park');
        });
    }
}