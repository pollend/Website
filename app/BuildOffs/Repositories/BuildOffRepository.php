<?php

namespace PN\BuildOffs\Repositories;


use PN\BuildOffs\BuildOff;
use PN\Foundation\Repositories\BaseRepository;

class BuildOffRepository extends BaseRepository implements BuildOffRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BuildOff::class;
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

        \Cache::put('buildoffs.'.$entity->id, $entity, 3600);
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

        \Cache::put('buildoffs.'.$entity->id, $entity, 3600);
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

        \Cache::forget('buildoffs.'.$entity->id);
    }

    public function descended()
    {
        return
    }
}
