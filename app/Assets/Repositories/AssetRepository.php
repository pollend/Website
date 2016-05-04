<?php

namespace PN\Assets\Repositories;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use PN\Assets\Asset;
use PN\BuildOffs\BuildOff;
use PN\Foundation\Repositories\BaseRepository;
use PN\Users\User;

class AssetRepository extends BaseRepository implements AssetRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Asset::class;
    }

    public function mostPopular($count)
    {
        return \Cache::remember('assets.mostpopular', 10, function () use ($count) {
            $assets = app($this->model())->orderBy('hot_score', 'desc')->take($count * 4)->get();

            return $assets->random($count);
        });
    }

    public function newest($count)
    {
        return \Cache::remember('assets.newest', 10, function () use ($count) {
            return app($this->model())->orderBy('created_at', 'desc')->take($count)->get();
        });
    }

    public function find($id, $columns = ['*'])
    {
        return \Cache::remember('assets.'.$id, 3600, function() use ($id, $columns){
            return parent::find($id, $columns);
        });
    }

    public function findByIdentifier(string $identifier)
    {
        $id = \Cache::remember('assets.'.$identifier, 3600, function() use($identifier){
            $asset = parent::findByIdentifier($identifier);

            return $asset->id;
        });

        return $this->find($id);
    }

    public function add($entity)
    {
        $entity->save();

        \Cache::put('assets.'.$entity->id, $entity, 3600);
    }

    public function edit($entity)
    {
        $entity->save();

        \Cache::put('assets.'.$entity->id, $entity, 3600);
    }

    public function remove($entity)
    {
        $entity->delete();

        \Cache::forget('assets.'.$entity->id);
    }

    /**
     * Gets assets that participated in a build-off
     *
     * @param BuildOff $buildOff
     * @return mixed
     */
    public function forBuildOff(BuildOff $buildOff)
    {
        return Asset::where('buildoff_id', $buildOff->id)->get();
    }

    /**
     * Gets assets uploaded by given users, can paginate
     *
     * @param User $user
     * @param bool $paginated
     * @param int $perPage
     * @return Collection|Paginator
     */
    public function forUser(User $user, $paginated = false, $perPage = 12)
    {
        $assets = Asset::where('user_id', $user->id)->orderBy('created_at', 'desc');

        if($paginated) {
            return $assets->paginate($perPage);
        }

        return $assets->get();
    }

    /**
     * Counts the total assets of given type
     * 
     * @param $type
     * @return mixed
     */
    public function countByType($type)
    {
        return Asset::where('type', $type)->count();
    }

    /**
     * Finds assets by type
     *
     * @param $type
     * @return mixed
     */
    public function findByType($type)
    {
        return Asset::where('type', $type)->get();
    }
}
