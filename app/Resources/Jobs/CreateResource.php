<?php

namespace PN\Resources\Jobs;


use PN\Resources\Events\ResourceCreated;
use PN\Jobs\Job;

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

    public function handle()
    {
        $resource = \ResourceUtil::make($this->resource);

        $resource->save();

        event(new ResourceCreated($resource));

        return $resource;
    }
}
