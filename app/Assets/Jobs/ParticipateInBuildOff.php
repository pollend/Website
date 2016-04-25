<?php


namespace PN\Assets\Jobs;


use PN\Assets\Asset;
use PN\BuildOffs\BuildOff;
use PN\BuildOffs\Exceptions\AssetMayNotParticipateInBuildOff;
use PN\Jobs\Job;

/**
 * Class ParticipateInBuildOff
 * @package PN\Assets\Jobs
 */
class ParticipateInBuildOff extends Job
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var BuildOff
     */
    private $buildOff;

    /**
     * ParticipateInBuildOff constructor.
     * @param Asset $asset
     * @param BuildOff $buildOff
     */
    public function __construct(Asset $asset, BuildOff $buildOff)
    {
        $this->asset = $asset;
        $this->buildOff = $buildOff;
    }

    public function handle()
    {
        if (!$this->buildOff->eligible($this->asset)) {
            $msg = sprintf("Asset: %s buildoff: %s", $this->asset->id, $this->buildOff->id);
            throw new AssetMayNotParticipateInBuildOff($msg);
        }

        $this->asset->setBuildOff($this->buildOff);

        \AssetRepo::edit($this->asset);
    }
}