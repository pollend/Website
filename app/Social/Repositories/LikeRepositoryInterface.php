<?php


namespace PN\Social\Repositories;


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
}