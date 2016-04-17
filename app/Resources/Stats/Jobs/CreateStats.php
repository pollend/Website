<?php

namespace PN\Resources\Stats\Jobs;


use Illuminate\Contracts\Queue\ShouldQueue;
use PN\Assets\Jobs\CreateBlueprintStats;
use PN\Assets\Jobs\CreateParkStats;
use PN\Jobs\Job;
use PN\Resources\Resource;

/**
 * Class CreateStats
 * @package PN\Resources\Stats\Jobs
 */
class CreateStats extends Job implements ShouldQueue
{
    /**
     * @var \PN\Resources\Resource
     */
    private $resource;

    /**
     * CreateStats constructor.
     * @param $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return mixed|null
     */
    public function handle()
    {
        switch($this->resource->type) {
            case 'blueprint':
                $this->dispatch(app(CreateBlueprintStats::class, [$this->resource]));
                break;
            case 'park':
                $this->dispatch(app(CreateParkStats::class, [$this->resource]));
                break;
        }
    }
}
