<?php

namespace PN\Assets\Repositories\Criteria;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class SortCriteria implements CriteriaInterface
{
    private $sort;

    public function __construct($sort)
    {
        $this->sort = $sort;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->sort == 'best' || $this->sort == '') {
            return $model->orderBy('likes', 'desc');
        }
        if ($this->sort == 'hot_score') {
            return $model->orderBy('hot_score', 'desc');
        }
        if ($this->sort == 'downloads') {
            return $model->orderBy('downloads', 'desc');
        }
        if ($this->sort == 'views') {
            return $model->orderBy('views', 'desc');
        }
        if ($this->sort == 'newest') {
            return $model->orderBy('created_at', 'desc');
        }
    }
}
