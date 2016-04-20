<?php


namespace PN\Social\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Social\Repositories\CommentRepositoryInterface;

class CommentRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return CommentRepositoryInterface::class;
    }
}