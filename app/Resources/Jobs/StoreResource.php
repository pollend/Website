<?php


namespace PN\Resources\Jobs;


use PN\Jobs\Job;
use PN\Resources\Resource;
use PN\Resources\Stats\Jobs\CreateStats;

/**
 * Class StoreResource
 * @package PN\Resources\Jobs
 */
class StoreResource extends Job
{
    /**
     * @var Resource
     */
    private $resource;

    /**
     * StoreResource constructor.
     * @param $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     *
     */
    public function handle() : Resource
    {
        $exists = $this->resource->id != null;

        $this->resource->save();

        if(!$exists) {
            $this->dispatch(app(CreateStats::class, [$this->resource]));
        }

        return $this->resource;
    }
}