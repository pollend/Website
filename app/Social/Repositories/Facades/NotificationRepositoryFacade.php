<?php


namespace PN\Social\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Social\Repositories\NotificationRepositoryInterface;

class NotificationRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return NotificationRepositoryInterface::class;
    }
}