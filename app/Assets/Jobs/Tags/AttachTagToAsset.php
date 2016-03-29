<?php

namespace PN\Assets\Jobs\Tags;


use PN\Assets\Events\TagWasAttachedToAsset;
use PN\Assets\Events\TagWasDetachedFromAsset;
use PN\Jobs\Job;

class AttachTagToAsset extends Job
{
    private $asset;

    private $tag;

    /**
     * AttachTagToAsset constructor.
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
        if($this->asset->tags()->find($this->tag->id) == null) {
            $this->asset->tags()->attach([$this->tag->id]);

            event(new TagWasAttachedToAsset($this->asset, $this->tag));
        }
    }
}
