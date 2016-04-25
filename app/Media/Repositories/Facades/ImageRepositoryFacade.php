<?php


namespace PN\Media\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Media\Repositories\ImageRepositoryInterface;

class ImageRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return ImageRepositoryInterface::class;
    }
}