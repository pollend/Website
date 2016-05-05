<?php


namespace PN\Media\Repositories;


use PN\Foundation\Repositories\BaseRepositoryInterface;

interface ScreenshotRepositoryInterface extends BaseRepositoryInterface
{
    public function random();

    public function descended($paginated = false, $perPage = 12);
}