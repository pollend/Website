<?php


namespace PN\Social\Repositories;


use PN\Foundation\Repositories\BaseRepository;
use PN\Social\Like;
use PN\Users\User;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Like::class;
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

        return $entity;
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

        return $entity;
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
     * Returns the like count for this user
     *
     * @param User $user
     * @return mixed
     */
    public function likeCountForUser(User $user)
    {
        // TODO make this not so crappy
        return \Cache::remember(sprintf("user.%s.likecount", $user->id), 60, function() use ($user) {
            $likes = 0;

            foreach ($user->getAssets() as $asset) {
                $likes += $asset->like_count;
            }

            foreach ($user->getScreenshots() as $screenshot) {
                $likes += $screenshot->like_count;
            }
            
            // TODO include posts

            return $likes;
        });
    }
}