<?php

namespace PN\Social;


use PN\Foundation\Presenters\Presenter;

class CommentPresenter extends Presenter
{
    public function timestamp()
    {
        return date('d F Y, H:i', strtotime($this->model->created_at));
    }

    public function text()
    {
        return MarkdownParser::parse($this->model->body);
    }

    public function url()
    {
        // comments don't have a dedicated url, return the asset one instead
        $asset = $this->model->getAsset();

        return $asset->getPresenter()->url();
    }
}
