<?php


namespace PN\Media\Jobs;


use PN\Assets\Asset;
use PN\Media\Image;

/**
 * Class AddImageToAsset
 * @package PN\Media\Jobs
 */
class AddImageToAsset
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var Image
     */
    private $image;

    /**
     * AddImageToAsset constructor.
     * @param Asset $asset
     * @param Image $image
     */
    public function __construct(Asset $asset, Image $image)
    {
        $this->asset = $asset;
        $this->image = $image;
    }

    public function handle()
    {
        $this->asset->addImage($this->image);
    }
}