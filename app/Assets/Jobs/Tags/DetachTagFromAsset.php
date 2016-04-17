<?php

namespace PN\Assets\Jobs\Tags;


use PN\Assets\Events\TagWasDetachedFromAsset;
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
    public function __construct($asset, $tag)
    {
        $this->asset = $asset;
        $this->tag = $tag;
    }

    public function handle()
    {
        $tag = $this->tag;

        $tagExists = function($item) use ($tag) {
            return $item->id == $tag->id;
        };

        if(count($this->asset->getTags()->filter($tagExists)) > 0) {
            $this->asset->removeTag($this->tag->id);

            event(new TagWasDetachedFromAsset($this->asset, $this->tag));
        }
    }
}
