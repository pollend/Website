<?php

namespace PN\Resources\Stats\Jobs;


use PN\Resources\Resource;
use PN\Resources\Stats\ResourceStat;
use PN\Resources\Stats\Stat;
use PN\Jobs\Job;

/**
 * Class CreateBlueprintStats
 * @package PN\Assets\Jobs
 */
class CreateBlueprintStats extends Job
{
    /**
     * @var \PN\Resources\Resource
     */
    private $resource;

    /**
     * CreateBlueprintStats constructor.
     * @param $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return null
     */
    public function handle()
    {
        if (!$this->resource->getStrategy()->isCoaster()) {
            return null;
        }

        $blueprintStats = $this->resource->getExtractor()->getStats();

        foreach ($blueprintStats as $key => $value) {
            $stat = Stat::where('name', $key)->first();

            if ($stat != null) {
                ResourceStat::create([
                    'resource_id' => $this->resource->id,
                    'stat_id' => $stat->id,
                    'value' => $value
                ]);
            }
        }
    }
}
