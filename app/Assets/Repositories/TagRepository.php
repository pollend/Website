<?php

namespace PN\Assets\Repositories;


use PN\Assets\Tag;
use PN\Foundation\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function findPrimary($type)
    {
        return Tag::where('primary', 1)
            ->where('type', $type)
            ->orderBy('tag')
            ->get();
    }

    public function findSecondary($type)
    {
        return Tag::where('primary', 0)
            ->where('type', $type)
            ->orderBy('tag')
            ->get();
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

    public function findByIds($ids)
    {
        return $this->findWhereIn('id', $ids);
    }

    public function findBySlugs($slugs)
    {
        return $this->findWhereIn('slug', $slugs);
    }
}
