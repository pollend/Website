<?php


namespace PN\Resources;


class ResourceStrategy
{
    /**
     * @var Resource
     */
    protected $resource;

    /**
     * ResourceStrategy constructor.
     * @param $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }
}