<?php

namespace PN\Assets\Events;


class TagWasAttachedToAsset
{
    public $asset;

    public $tag;

    /**
     * TagWasAttachedToAsset constructor.
     * @param $asset
     * @param $tag
     */
    public function __construct($asset, $tag)
    {
        $this->asset = $asset;
        $this->tag = $tag;
    }
}
