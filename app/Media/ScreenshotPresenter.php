<?php


namespace PN\Media;


use Illuminate\Support\Str;
use PN\Foundation\Presenters\Presenter;

class ScreenshotPresenter extends Presenter
{
    public function url()
    {
        return route('screenshots.show', [$this->model->identifier, Str::slug($this->model->title)]);
    }

    public function editUrl()
    {
        return route('screenshots.edit', [$this->model->identifier]);
    }

    public function deleteUrl()
    {
        return route('screenshots.delete', [$this->model->identifier]);
    }
}