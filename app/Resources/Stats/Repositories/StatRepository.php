<?php


namespace PN\Resources\Stats\Repositories;


use PN\Foundation\Repositories\BaseRepository;
use PN\Resources\Stats\Stat;

class StatRepository extends BaseRepository implements StatRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Stat::class;
    }

    public function findBySlug($slug)
    {
        return Stat::where('slug', $slug)->first();
    }

    public function find($id, $columns = array('*'))
    {
        return \Cache::remember('stat.'.$id, 3600, function() use ($id, $columns) {
            return parent::find($id, $columns);
        });
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

        \Cache::put('stats.'.$entity->id, $entity, 3600);
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

        \Cache::put('stats.'.$entity->id, $entity, 3600);
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

        \Cache::forget('stats.'.$entity->id);
    }
}