<?php

namespace PN\Resources;


use PN\Foundation\Presenters\Presenter;

class ImagePresenter extends Presenter
{
    public function source()
    {
        return '/media/images/' . $this->model->source;
    }
}
