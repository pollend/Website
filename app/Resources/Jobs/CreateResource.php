<?php

namespace PN\Resources\Jobs;


use PN\Resources\Events\ResourceCreated;
use PN\Jobs\Job;
use PN\Resources\Resource;

class CreateResource extends Job
{
    private $source;

    /**
     * CreateResource constructor.
     * @param $source
     */
    public function __construct($source)
    {
        $this->source = $source;
    }

    public function handle() : Resource
    {
        $resource = \ResourceUtil::make($this->source);

        $this->dispatch(new StoreResource($resource));

        event(new ResourceCreated($resource));

        return $resource;
    }
}
