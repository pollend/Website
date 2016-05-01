<?php


namespace PN\Assets\Filter;


use Illuminate\Database\Eloquent\Builder;

class SortByFilter implements FilterInterface
{
    private $sort;

    public function setFilterValue($value) : FilterInterface
    {
        $this->sort = $value;

        return $this;
    }

    public function appendQuery($model) : Builder
    {
        if ($this->sort == 'best') {
            return $model->orderBy('like_count', 'desc');
        }
        if ($this->sort == 'hot_score') {
            return $model->orderBy('hot_score', 'desc');
        }
        if ($this->sort == 'downloads') {
            return $model->orderBy('download_count', 'desc');
        }
        if ($this->sort == 'views') {
            return $model->orderBy('view_count', 'desc');
        }
        if ($this->sort == 'newest') {
            return $model->orderBy('id', 'desc');
        }
    }
}