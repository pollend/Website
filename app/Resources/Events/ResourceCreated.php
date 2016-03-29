<?php

namespace PN\Resources\Events;


use PN\Events\Event;

class ResourceCreated extends Event
{
    public $resource;

    /**
     * ResourceCreated constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }
}
