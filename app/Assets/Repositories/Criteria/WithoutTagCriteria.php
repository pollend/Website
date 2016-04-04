<?php

namespace PN\Assets\Repositories\Criteria;


use PN\Assets\Tag;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WithoutTagCriteria implements CriteriaInterface
{
    private $tags;

    /**
     * WithoutTagCriteria constructor.
     * @param $tags
     */
    public function __construct($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Apply criteria in query repository
     *
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $tagIds = Tag::whereIn('slug', $this->tags)->get(['id'])->lists('id');
        return $model->where(function ($query) use ($tagIds, $model) {
            foreach ($tagIds as $tagId) {
                $query->whereNotIn('id', function ($query) use ($tagId) {
                    $query->select('asset_id')
                        ->from('asset_tags')
                        ->where('tag_id', $tagId);
                });
            }
        });
    }
}
