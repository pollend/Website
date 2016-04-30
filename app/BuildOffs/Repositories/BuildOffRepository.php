<?php

namespace PN\BuildOffs\Repositories;


use Illuminate\Database\Eloquent\Collection;
use PN\Assets\Asset;
use PN\BuildOffs\BuildOff;
use PN\Foundation\Repositories\BaseRepository;
use PN\Resources\Resource;

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
        return \PN\BuildOffs\BuildOff::orderBy('end', 'desc')->get();
    }

    /**
     * Gets all buildoffs that need to be closed
     *
     * @return Collection
     */
    public function overdue()
    {
        return BuildOff::where('end', '<', date('Y-m-d'))->get();
    }

    /**
     * Gets assets sorted on likes
     *
     * @param BuildOff $buildOff
     * @return mixed
     */
    public function getAssetsSorted(BuildOff $buildOff)
    {
        $assets = \AssetRepo::forBuildOff($buildOff);

        return $assets->sortByDesc('likes');
    }

    /**
     * Get buildoffs where this asset can participate in
     * @param Resource $resource
     * @return mixed
     */
    public function getEligibleForResource(Resource $resource)
    {
        $resource->getPrimaryTags();
    }
}
