<?php

namespace PN\Assets\Jobs\Tags;


use PN\Assets\Asset;
use PN\Assets\Events\TagWasDetachedFromAsset;
use PN\Assets\Tag;
use PN\Jobs\Job;

class DetachTagFromAsset extends Job
{
    /**
     * @var \PN\Assets\Asset
     */
    private $asset;

    /**
     * @var \PN\Assets\Tag
     */
    private $tag;

    /**
     * DetachTagFromAsset constructor.
     * @param $asset
     * @param $tag
     */
    public function __construct(Asset $asset, Tag $tag)
    {
        $this->asset = $asset;
        $this->tag = $tag;
    }

    public function handle()
    {
        $this->asset->removeTag($this->tag);

        event(new TagWasDetachedFromAsset($this->asset, $this->tag));
    }
}
