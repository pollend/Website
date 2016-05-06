<?php


namespace PN\Assets\Jobs;


use PN\Assets\Asset;
use PN\Jobs\Job;

/**
 * Class ResetDependencies
 * @package PN\Assets\Jobs
 */
class ResetDependencies extends Job
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * ResetDependencies constructor.
     * @param Asset $asset
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function handle()
    {
        $deps = $this->asset->getDependencies();

        foreach ($deps as $dep) {
            $this->asset->removeDependency($dep);
        }
    }
}