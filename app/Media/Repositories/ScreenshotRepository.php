<?php


namespace PN\Media\Repositories;


use PN\Foundation\Repositories\BaseRepository;
use PN\Media\Screenshot;

class ScreenshotRepository extends BaseRepository implements ScreenshotRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Screenshot::class;
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

    public function random()
    {
        return Screenshot::orderBy(\DB::raw('RAND()'))->first();
    }
}