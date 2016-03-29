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
        if($this->asset->tags()->find($this->tag->id) != null) {
            $this->asset->tags()->detach([$this->tag->id]);

            event(new TagWasDetachedFromAsset($this->asset, $this->tag));
        }
    }
}
