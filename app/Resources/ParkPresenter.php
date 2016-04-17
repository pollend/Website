<?php

namespace PN\Resources;


use PN\Foundation\Presenters\Presenter;

class ParkPresenter extends Presenter
{
    public function imageUrl()
    {
        return $this->model->getImage()->source;
    }
}
