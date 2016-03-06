<?php

namespace PN\BuildOffs\Repositories;


use PN\BuildOffs\Rank;
use PN\Foundation\Repositories\BaseRepository;

class RankRepository extends BaseRepository implements RankRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rank::class;
    }
}
