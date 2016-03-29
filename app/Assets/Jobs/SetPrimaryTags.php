<?php

namespace PN\Assets\Jobs;


use PN\Assets\Jobs\Tags\AttachTagToAsset;
use PN\Assets\Repositories\TagRepositoryInterface;
use PN\Jobs\Job;

class SetPrimaryTags extends Job
{
    private $asset;

    private $tagRepo;

    /**
     * SetPrimaryTags constructor.
     * @param $asset
     */
    public function __construct($asset, TagRepositoryInterface $tagRepo)
    {
        $this->asset = $asset;
        $this->tagRepo = $tagRepo;
    }

    public function handle()
    {
        $primaryTags = $this->asset->resource->getPrimaryTags();

        $tags = $this->tagRepo->findByPrimaryTags($primaryTags->toArray());

        foreach($tags as $tag) {
            $this->dispatch(app(AttachTagToAsset::class, [$this->asset, $tag]));
        }
    }
}
