<?php

namespace PN\Assets\Jobs\Tags;


use PN\Assets\Repositories\TagRepositoryInterface;
use PN\Jobs\Job;

class DetachPrimaryTagsFromAsset extends Job
{
    /**
     * @var \PN\Assets\Asset
     */
    private $asset;

    /**
     * @var TagRepositoryInterface
     */
    private $tagRepository;

    /**
     * DetachPrimaryTagsFromAsset constructor.
     * @param $asset
     * @param $tagRepository TagRepositoryInterface
     */
    public function __construct($asset, TagRepositoryInterface $tagRepository)
    {
        $this->asset = $asset;
        $this->tagRepository = $tagRepository;
    }


    public function handle()
    {
        $tags = $this->tagRepository->findPrimary($this->asset->type);

        foreach($tags as $tag) {
            $this->dispatch(app(DetachTagFromAsset::class, [$this->asset, $tag]));
        }
    }
}
