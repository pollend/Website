<?php

namespace PN\Assets;


use PN\Foundation\Presenters\Presenter;

class AssetPresenter extends Presenter
{
    public function url()
    {
        return route('assets.show', [$this->model->identifier, $this->model->slug]);
    }
    public function downloadable()
    {
        return $this->model->type != 'mod';
    }

    public function downloadUrl()
    {
        return route('resources.download', [$this->model->identifier]);
    }

    public function imageUrl()
    {

    }
}
