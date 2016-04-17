<?php


namespace PN\Assets\Filter;


use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function setFilterValue($value) : FilterInterface;

    public function appendQuery($model) : Builder;
}