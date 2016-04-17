<?php

namespace PN\Assets\Jobs;


use PN\Assets\Asset;
use PN\Assets\Jobs\Tags\AttachTagToAsset;
use PN\Assets\Repositories\TagRepositoryInterface;
use PN\Jobs\Job;

class SetPrimaryTags extends Job
{
    private $asset;

    /**
     * SetPrimaryTags constructor.
     * @param $asset
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function handle()
    {
        $primaryTags = $this->asset->getResource()->getPrimaryTags();

        $tags = \TagRepo::findByPrimaryTags($primaryTags->toArray());

        foreach($tags as $tag) {
            $this->asset->addTag($tag);
        }
    }
}
