<?php


namespace PN\Social\Repositories;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * Gets likes for given user, can be filtered by type (model) and limited by total
     *
     * @param User $user
     * @param null $type
     * @param bool $paginate
     * @param int $perPage
     * @return Collection|Paginator
     */
    public function recentForUser(User $user, $type = null, $paginate = false, $perPage = 12)
    {
        $likes = Like::whereIn('id', function($query) use ($user, $type) {
            $query->select(\DB::raw('MAX(id)'))
                ->from('likes')
                ->where('user_id', $user->id);

            if($type != null) {
                $query->where('likeable_type', $type);
            }

            $query->groupBy('likeable_type', 'likeable_id');
        })->orderBy('created_at', 'desc');

        if($paginate) {
            return $likes->paginate($perPage);
        }

        return $likes->get();
    }

    /**
     * Finds like for user and likeable
     *
     * @param User $user
     * @param Model $likeable
     * @return mixed
     */
    public function findByUserAndLikeable(User $user, Model $likeable)
    {
        return Like::where('user_id', $user->id)
            ->where('likeable_id', $likeable->id)
            ->where('likeable_type', get_class($likeable))
            ->first();
    }
}