<?php


namespace PN\Foundation\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Foundation\ModelTypeResolver;

class ModelTypeResolverFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return ModelTypeResolver::class;
    }
}