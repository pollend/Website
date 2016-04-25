<?php


namespace PN\Pages\Repositories;


use PN\Foundation\Repositories\BaseRepository;
use PN\Pages\Page;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Page::class;
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

        \Cache::put('pages.'.$entity->id, $entity);
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

        \Cache::put('pages.'.$entity->id, $entity);
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

        \Cache::forget('pages.'.$entity->id);
    }

    /**
     * Finds page by slug
     *
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return Page::where('slug', $slug)->firstOrFail();
    }
}