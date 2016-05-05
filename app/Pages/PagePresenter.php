<?php


namespace PN\Pages;


use PN\Foundation\Presenters\Presenter;
use PN\Social\MarkdownParser;

class PagePresenter extends Presenter
{
    public function getContent()
    {
        return MarkdownParser::parse($this->model->content);
    }
}