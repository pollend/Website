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
}
