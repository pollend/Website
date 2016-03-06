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
}
