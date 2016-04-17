<?php


namespace PN\Assets\Filter;


use Illuminate\Database\Eloquent\Builder;

class NameLikeFilter implements FilterInterface
{
    private $name;

    public function setFilterValue($value) : FilterInterface
    {
        $this->name = $value;

        return $this;
    }

    public function appendQuery($model) : Builder
    {
        return $model->where('name', 'like', "%{$this->name}%");
    }
}