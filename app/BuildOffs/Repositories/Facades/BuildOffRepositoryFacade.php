<?php

namespace PN\BuildOffs\Repositories\Facades;

use Illuminate\Support\Facades\Facade;
use PN\BuildOffs\Repositories\BuildOffRepositoryInterface;

class BuildOffRepositoryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BuildOffRepositoryInterface::class;
    }
}