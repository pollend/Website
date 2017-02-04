<?php


namespace PN\Assets\Filter;


use Illuminate\Database\Eloquent\Builder;

class WithTagFilter implements FilterInterface
{
    private $tags;

    public function setFilterValue($value) : FilterInterface
    {
        $this->tags = $value;

        return $this;
    }

    public function appendQuery($model) : Builder
    {
        $tagIds = $this->tags->pluck('id');

        return $model->where(function ($query) use ($tagIds, $model) {
            foreach ($tagIds as $tagId) {
                $query->orWhereIn('id', function ($query) use ($tagId) {
                    $query->select('asset_id')
                        ->from('asset_tags')
                        ->where('tag_id', $tagId);
                });
            }
        });
    }
}