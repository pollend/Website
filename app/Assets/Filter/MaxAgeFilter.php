<?php


namespace PN\Assets\Filter;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class MaxAgeFilter implements FilterInterface
{
    private $maxAge;

    public function setFilterValue($value) : FilterInterface
    {
        $this->maxAge = $value;

        return $this;
    }

    public function appendQuery($model) : Builder
    {
        return $model->where('created_at', '>', $this->maxAge->format('Y-m-d'));
    }
}