<?php


namespace PN\BuildOffs\Jobs;


use PN\BuildOffs\BuildOff;
use PN\BuildOffs\Rank;
use PN\Jobs\Job;

/**
 * Class RankBuildOff
 * @package PN\BuildOffs\Jobs
 */
class RankBuildOff extends Job
{
    /**
     * @var BuildOff
     */
    private $buildOff;

    /**
     * RankBuildOff constructor.
     * @param $buildOff
     */
    public function __construct(BuildOff $buildOff)
    {
        $this->buildOff = $buildOff;
    }

    /**
     *
     */
    public function handle()
    {
        if($this->buildOff->wasPreviouslyRanked()) {
            return;
        }

        $assets = \BuildOffRepo::getAssetsSorted($this->buildOff);

        $place = 1;
        foreach($assets as $asset) {
            $rank = new Rank();
            
            $rank->setBuildOff($this->buildOff);
            $rank->setAsset($asset);
            $rank->score = $asset->likes;
            $rank->rank = $place++;

            \RankRepo::add($rank);
        }
    }
}