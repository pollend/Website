<?php


namespace PN\Social\Repositories;


use PN\Foundation\Repositories\BaseRepositoryInterface;
use PN\Users\User;

interface NotificationRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Returns all unread notifications
     *
     * @param $user User
     * @return mixed
     */
    public function unread(User $user);
}