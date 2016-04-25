<?php

namespace PN\Assets\Jobs\Tags;


use PN\Assets\Asset;
use PN\Jobs\Job;

class DetachPrimaryTagsFromAsset extends Job
{
    /**
     * @var \PN\Assets\Asset
     */
    private $asset;

    /**
     * DetachPrimaryTagsFromAsset constructor.
     * @param $asset
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function handle()
    {
        $tags = \TagRepo::findPrimary($this->asset->type);

        foreach($tags as $tag) {
            $this->dispatch(app(DetachTagFromAsset::class, [$this->asset, $tag]));
        }
    }
}
