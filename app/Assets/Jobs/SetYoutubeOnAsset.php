<?php

namespace PN\Assets\Jobs;


use PN\Jobs\Job;

class SetYoutubeOnAsset extends Job
{
    private $asset;

    private $youtube;

    /**
     * SetYoutubeOnAsset constructor.
     * @param $asset
     * @param $youtube
     */
    public function __construct($asset, $youtube)
    {
        $this->asset = $asset;
        $this->youtube = $youtube;
    }

    public function handle()
    {
        $this->asset->youtube = $this->youtube;

        \AssetRepo::edit($this->asset);
    }
}
