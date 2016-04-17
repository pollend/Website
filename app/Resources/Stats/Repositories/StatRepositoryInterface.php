<?php


namespace PN\Resources\Stats\Repositories;


use PN\Foundation\Repositories\BaseRepositoryInterface;

interface StatRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug($slug);
}