<?php


namespace PN\Social\Repositories;


use PN\Foundation\Repositories\BaseRepository;
use PN\Social\Notification;
use PN\Users\User;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Notification::class;
    }

    /**
     * Adds the entity to this repository
     *
     * @param $entity
     * @return mixed
     */
    public function add($entity)
    {
        $entity->save();
    }

    /**
     * Updates the entity to this repository
     *
     * @param $entity
     * @return mixed
     */
    public function edit($entity)
    {
        $entity->save();
    }

    /**
     * Removes the entity from this repository
     *
     * @param $entity
     * @return mixed
     */
    public function remove($entity)
    {
        $entity->delete();
    }

    /**
     * Returns all unread notifications
     *
     * @return mixed
     */
    public function unread(User $user)
    {
        return Notification::where('user_id', $user->id)->where('read', 0)->orderBy('id', 'desc')->get();
    }
}