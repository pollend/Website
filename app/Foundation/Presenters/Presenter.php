<?php

namespace PN\Foundation\Presenters;


class Presenter
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return $this->$key();
        }

        return null;
    }
}
