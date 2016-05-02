<?php


namespace PN\Social\Repositories;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PN\Foundation\Repositories\BaseRepositoryInterface;
use PN\Users\User;

interface LikeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Returns the like count for this user
     *
     * @param User $user
     * @return mixed
     */
    public function likeCountForUser(User $user);

    /**
     * Gets likes for given user, can be filtered by type (model) and limited by total
     *
     * @param User $user
     * @param null $type
     * @param bool $paginate
     * @param int $perPage
     * @return Collection|Paginator
     */
    public function recentForUser(User $user, $type = null, $paginate = true, $perPage = 12);

    /**
     * Finds like for user and likeable
     * 
     * @param User $user
     * @param Model $likeable
     * @return mixed
     */
    public function findByUserAndLikeable(User $user, Model $likeable);
}