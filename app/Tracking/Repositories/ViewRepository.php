<?php


namespace PN\Tracking\Repositories;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use PN\Foundation\Repositories\BaseRepository;
use PN\Tracking\View;
use PN\Users\User;

class ViewRepository extends BaseRepository implements ViewRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return View::class;
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
     * Gets views for given user, can be filtered by type (model) and limited by total
     *
     * @param User $user
     * @param null $type
     * @param bool $paginate
     * @param int $perPage
     * @return Collection|Paginator
     */
    public function recentForUser(User $user, $type = null, $paginate = false, $perPage = 12)
    {
        $views = View::whereIn('id', function($query) use ($user, $type) {
            $query->select(\DB::raw('MAX(id)'))
                ->from('views')
                ->where('user_id', $user->id);

            if($type != null) {
                $query->where('viewable_type', $type);
            }

            $query->groupBy('viewable_type', 'viewable_id');
        })->orderBy('created_at', 'desc');

        if($paginate) {
            return $views->paginate($perPage);
        }

        return $views->get();
    }
}