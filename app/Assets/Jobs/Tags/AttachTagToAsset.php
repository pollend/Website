<?php

namespace PN\Assets\Jobs\Tags;


use Illuminate\Database\QueryException;
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
        try {
            $this->asset->addTag($this->tag);

            event(new TagWasAttachedToAsset($this->asset, $this->tag));
        } catch (QueryException $e) {
            // ignore, can't add one tag twice
        }
    }
}
