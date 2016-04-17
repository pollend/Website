<?php


namespace PN\Assets\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Assets\Repositories\AssetRepositoryInterface;

class AssetRepositoryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AssetRepositoryInterface::class;
    }
}