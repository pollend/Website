<?php


namespace PN\Assets\Jobs\Tags;


use PN\Assets\Asset;
use PN\Jobs\Job;

class ResetSecondaryTags extends Job
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * ResetSecondaryTags constructor.
     * @param $asset
     */
    public function __construct($asset)
    {
        $this->asset = $asset;
    }

    public function handle()
    {
        $tags = \TagRepo::findByPrimaryTags($this->asset->getResource()->getPrimaryTags()->toArray());

        $this->asset->setTags($tags);
    }
}