<?php

namespace PN\Resources;


use PN\Foundation\Presenters\Presenter;

class ParkPresenter extends Presenter implements ResourcePresenterInterface
{
    public function imageUrl()
    {
        return $this->model->getImage()->source;
    }

    public function getStatGroups()
    {
        return [];
    }
}
