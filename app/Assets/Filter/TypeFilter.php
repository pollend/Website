<?php


namespace PN\Assets\Filter;


use Illuminate\Database\Eloquent\Builder;

class TypeFilter implements FilterInterface
{
    private $type;

    public function setFilterValue($value) : FilterInterface
    {
        $this->type = $value;

        return $this;
    }

    public function appendQuery($model) : Builder
    {
        return $model->where('type', $this->type);
    }
}