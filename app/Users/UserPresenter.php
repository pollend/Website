<?php

namespace PN\Users;


use PN\Foundation\Presenters\Presenter;

class UserPresenter extends Presenter
{
    public function displayName()
    {
        $name = $this->model->name;

        if($name == '') {
            return $this->model->username;
        }

        return $name;
    }
}
