<?php

namespace PN\Assets;


use PN\Foundation\Presenters\Presenter;
use PN\Social\MarkdownParser;

class AssetPresenter extends Presenter
{
    public function url()
    {
        return route('assets.show', [$this->model->identifier, $this->model->slug]);
    }

    public function downloadUrl()
    {
        return route('assets.download', [$this->model->identifier]);
    }

    public function installUrl()
    {
        return sprintf("parkitectnexus://install/%s", $this->model->identifier);
    }

    public function description()
    {
        return MarkdownParser::parse($this->model->description);
    }

    public function imageUrl()
    {

    }

    public function canBeDownloaded()
    {
        return in_array($this->model->type, ['park', 'blueprint']);
    }

    public function canBeInstalled()
    {
        return in_array($this->model->type, ['park', 'blueprint', 'mod']);
    }
}
