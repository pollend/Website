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
        return BuildOff::orderBy('end', 'desc')->get();
    }

    /**
     * Gets all buildoffs that need to be closed
     *
     * @return Collection
     */
    public function overdue()
    {
        return BuildOff::where('end', '<=', date('Y-m-d H:i:s'))->get();
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

        return $assets->sortByDesc(function($asset) {
            return $asset->like_count * 1000000 + $asset->download_count;
        });
    }

    /**
     * Get buildoffs where this asset can participate in
     * @param Resource $resource
     * @return mixed
     */
    public function getEligibleForResource(Resource $resource)
    {
        $tags = \TagRepo::findByPrimaryTags($resource->getPrimaryTags()->toArray());

        $buildOffs = new BuildOff();

        if(count($tags) > 0) {
            $buildOffs = $buildOffs->where(function($query) use ($tags) {
                $query->whereIn('tag_id', $tags->pluck('id')->toArray())->orWhereNull('tag_id');
            });
        }

        if($resource->getType() == 'blueprint') {
            $price = $resource->getExtractor()->getStats()['ApproximateCost'];

            $buildOffs->where('max_price', '>=', $price);
        }

        return $buildOffs->where('type_requirement', $resource->type)
            ->where('start', '<=', date('Y-m-d H:i:s'))
            ->where('end', '>=', date('Y-m-d H:i:s'))
            ->get();
    }
}
