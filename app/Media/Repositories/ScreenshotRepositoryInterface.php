<?php


namespace PN\Media\Repositories;


use PN\Foundation\Repositories\BaseRepositoryInterface;

interface ScreenshotRepositoryInterface extends BaseRepositoryInterface
{
    public function random();
}