<?php


namespace PN\Pages\Repositories;


use PN\Foundation\Repositories\BaseRepositoryInterface;

interface PageRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Finds page by slug
     * 
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);
}