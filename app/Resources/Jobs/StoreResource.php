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

        if(!$exists) {
            \ResourceRepo::add($exists);
            $this->dispatch(new CreateStats($this->resource));
        } else {
            \ResourceRepo::edit($exists);
        }

        return $this->resource;
    }
}
