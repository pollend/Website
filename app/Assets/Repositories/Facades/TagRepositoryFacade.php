<?php


namespace PN\Assets\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Assets\Repositories\TagRepositoryInterface;

class TagRepositoryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TagRepositoryInterface::class;
    }
}