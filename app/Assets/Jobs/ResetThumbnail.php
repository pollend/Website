<?php


namespace PN\Assets\Jobs;


use PN\Assets\Asset;
use PN\Jobs\Job;
use PN\Media\Jobs\CreateImageFromRaw;

/**
 * Class ResetThumbnail
 * @package PN\Assets\Jobs
 */
class ResetThumbnail extends Job
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * ResetThumbnail constructor.
     * @param Asset $asset
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function handle()
    {
        $image = $this->dispatch(new CreateImageFromRaw($this->asset->getResource()->getImage()->getRaw()));

        $this->asset->setImage($image);

        \AssetRepo::edit($this->asset);

        return $this->asset;
    }
}