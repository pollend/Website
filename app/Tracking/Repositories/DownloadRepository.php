<?php


namespace PN\Tracking\Repositories;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use PN\Foundation\Providers\CompileHelperTrait;
use PN\Foundation\Repositories\BaseRepository;
use PN\Tracking\Download;
use PN\Users\User;

class DownloadRepository extends BaseRepository implements DownloadRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Download::class;
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
     * Gets downloads for given user, can be filtered by type (model) and limited by total
     *
     * @param User $user
     * @param null $type
     * @param bool $paginate
     * @param int $perPage
     * @return Collection|Paginator
     */
    public function recentForUser(User $user, $type = null, $paginate = false, $perPage = 12)
    {
        $downloads = Download::whereIn('id', function($query) use ($user, $type) {
            $query->select(\DB::raw('MAX(id)'))
                ->from('downloads')
                ->where('user_id', $user->id);

            if($type != null) {
                $query->where('downloadable_type', $type);
            }

            $query->groupBy('downloadable_type', 'downloadable_id');
        })->orderBy('created_at', 'desc');

        if($paginate) {
            return $downloads->paginate($perPage);
        }

        return $downloads->get();
    }

    public static function compiles() {
        $files = [];

        $files = array_merge($files, CompileHelperTrait::filesInFolder(app_path('Tracking/Providers')));

        return $files;
    }

}