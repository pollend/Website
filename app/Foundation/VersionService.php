<?php


namespace PN\Foundation;


class VersionService
{
    public function getCurrentVersion()
    {
        return \Cache::remember('parkitect-version', 3600, function(){
            $content = file_get_contents('http://themeparkitect.com/version.json');

            $data = json_decode($content);

            return $data->newestVersionName;
        });
    }
}