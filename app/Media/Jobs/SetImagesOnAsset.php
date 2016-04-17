<?php


namespace PN\Media\Jobs;


use Illuminate\Support\Collection;
use PN\Assets\Asset;
use PN\Jobs\Job;

class SetImagesOnAsset extends Job
{
    private $asset;

    private $images;

    public function __construct(Asset $asset, Collection $images)
    {
        $this->asset = $asset;
        $this->images = $images;
    }

    public function handle()
    {
        $this->asset->setImages($this->images);
    }
}