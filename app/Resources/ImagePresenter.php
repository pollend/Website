<?php

namespace PN\Resources;


use PN\Foundation\Presenters\Presenter;

class ImagePresenter extends Presenter
{
    public function source($width = null, $height = null)
    {
        if(!$width || !$height) {
            $width = config('images.default_size')[0];
            $height = config('images.default_size')[1];
        }

        return "/media/images/{$width}x{$height}/" . $this->model->source;
    }
}
