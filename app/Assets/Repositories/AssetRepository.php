<?php

namespace PN\Assets\Repositories;


use PN\Assets\Asset;
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
}
