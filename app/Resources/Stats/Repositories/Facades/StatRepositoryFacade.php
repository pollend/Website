<?php


namespace PN\Resources\Stats\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Resources\Stats\Repositories\StatRepositoryInterface;

class StatRepositoryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return StatRepositoryInterface::class;
    }
}