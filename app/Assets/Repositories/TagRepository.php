<?php

namespace PN\Assets\Repositories;


use PN\Assets\Tag;
use PN\Foundation\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function findPrimary()
    {
        return $this->findByField('primary', 1);
    }

    public function findSecondary()
    {
        return $this->findByField('primary', 0);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }
}
