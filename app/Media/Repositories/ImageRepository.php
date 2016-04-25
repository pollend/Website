<?php


namespace PN\Media\Repositories;


use PN\Foundation\Repositories\BaseRepository;
use PN\Foundation\Repositories\BaseRepositoryInterface;
use PN\Media\Image;

class ImageRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Image::class;
    }

    public function add($entity)
    {
        $entity->save();

        \Cache::put('images.'.$entity->id, $entity, 3600);
    }

    public function edit($entity)
    {
        $entity->save();

        \Cache::put('images.'.$entity->id, $entity, 3600);
    }

    public function remove($entity)
    {
        $entity->delete();

        \Cache::forget('images.'.$entity->id);
    }
}