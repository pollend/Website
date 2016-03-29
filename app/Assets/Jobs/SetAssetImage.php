<?php

namespace PN\Assets\Jobs;


use PN\Jobs\Job;
use PN\Resources\Image;

class SetAssetImage extends Job
{
    /**
     * @var \PN\Assets\Asset
     */
    private $asset;

    /**
     * @var string
     */
    private $imageRaw;

    /**
     * SetAssetImage constructor.
     * @param $asset
     * @param $imageRaw
     */
    public function __construct($asset, $imageRaw)
    {
        $this->asset = $asset;
        $this->imageRaw = $imageRaw;
    }

    public function handle()
    {
        $image = Image::make($this->imageRaw);
        $image->save();

        $this->asset->setImage($image);

        $this->asset->save();

        return $this->asset;
    }
}
