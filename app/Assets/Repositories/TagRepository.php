<?php

namespace PN\Assets\Repositories;


use PN\Assets\Tag;
use PN\Foundation\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function findPrimary($type)
    {
        return $this->findWhere([
            'primary' => 1,
            'type' => $type
        ]);
    }

    public function findSecondary($type)
    {
        return $this->findWhere([
            'primary' => 0,
            'type' => $type
        ]);
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

    public function findByPrimaryTags($tagTypes)
    {
        return $this->findWhereIn('parkitect_type', $tagTypes);
    }

    public function findByTagName($name)
    {
        return $this->findWhere([
            'name' => $name
        ])->first();
    }
}
