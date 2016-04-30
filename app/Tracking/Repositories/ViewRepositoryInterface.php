<?php


namespace PN\Tracking\Repositories;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use PN\Foundation\Repositories\BaseRepositoryInterface;
use PN\Users\User;

/**
 * Interface ViewRepositoryInterface
 * @package PN\Tracking\Repositories
 */
interface ViewRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Gets views for given user, can be filtered by type (model) and limited by total
     *
     * @param User $user
     * @param null $type
     * @param bool $paginate
     * @param int $perPage
     * @return Collection|Paginator
     */
    public function recentForUser(User $user, $type = null, $paginate = true, $perPage = 15);
}