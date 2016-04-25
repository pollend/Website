<?php

namespace PN\Assets\Jobs;


use PN\Assets\Asset;
use PN\Jobs\Job;
use PN\Media\Image;

/**
 * Class SetAssetImage
 * @package PN\Assets\Jobs
 */
class SetAssetImage extends Job
{
    /**
     * @var \PN\Assets\Asset
     */
    private $asset;

    /**
     * @var Image
     */
    private $image;

    /**
     * SetAssetImage constructor.
     * @param $asset
     * @param $image
     */
    public function __construct(Asset $asset, Image $image)
    {
        $this->asset = $asset;
        $this->image = $image;
    }

    /**
     * @return Asset
     */
    public function handle() : Asset
    {
        $this->asset->setImage($this->image);

        \AssetRepo::add($this->asset);

        return $this->asset;
    }
}
