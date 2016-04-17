<?php

namespace PN\Resources\Jobs;


use PN\Resources\Events\ResourceCreated;
use PN\Jobs\Job;
use PN\Resources\Resource;

class CreateResource extends Job
{
    private $resource;

    /**
     * CreateResource constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function handle() : Resource
    {
        $resource = \ResourceUtil::make($this->resource);

        $this->dispatch(new StoreResource($resource));

        event(new ResourceCreated($resource));

        return $resource;
    }
}
