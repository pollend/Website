<?php

namespace PN\Assets\Repositories;


use Illuminate\Support\Collection;
use PN\Assets\Asset;
use PN\Assets\Repositories\Criteria\NameCriteria;
use PN\Assets\Repositories\Criteria\NoBuildOffCriteria;
use PN\Assets\Repositories\Criteria\SortCriteria;
use PN\Assets\Repositories\Criteria\StatCriteria;
use PN\Assets\Repositories\Criteria\TypeCriteria;
use PN\Assets\Repositories\Criteria\WithoutTagCriteria;
use PN\Assets\Repositories\Criteria\WithTagCriteria;
use PN\Foundation\Repositories\BaseRepository;

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
}
