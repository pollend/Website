<?php

namespace PN\Resources\Stats\Jobs;


use PN\Resources\Resource;
use PN\Resources\Stats\ResourceStat;
use PN\Resources\Stats\Stat;
use PN\Jobs\Job;

class CreateParkStats extends Job
{
    private $resource;

    /**
     * CreateBlueprintStats constructor.
     * @param $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function handle()
    {
        $parkStats = $this->resource->getExtractor()->getStats();

        foreach ($parkStats as $key => $value) {
            $stat = Stat::where('name', $key)->first();

            if($stat != null) {
                ResourceStat::create([
                    'resource_id' => $this->resource->id,
                    'stat_id' => $stat->id,
                    'value' => $value
                ]);
            }
        }
    }
}
