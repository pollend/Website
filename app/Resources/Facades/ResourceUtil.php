<?php

namespace PN\Resources\Facades;


use Illuminate\Support\Facades\Facade;

class ResourceUtil extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'resources.resourceutil';
    }
}
