<?php

namespace PN\Assets\Events;


use PN\Events\Event;

class TagWasDetachedFromAsset extends Event
{
    /**
     * @var \PN\Assets\Asset
     */
    public $asset;

    /**
     * @var \PN\Assets\Tag
     */
    public $tag;

    /**
     * TagWasDetachedFromAsset constructor.
     * @param $asset
     * @param $tag
     */
    public function __construct($asset, $tag)
    {
        $this->asset = $asset;
        $this->tag = $tag;
    }
}
