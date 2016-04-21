<?php


namespace PN\Pages;


use PN\Foundation\Presenters\Presenter;
use PN\Social\MarkdownParser;

class PagePresenter extends Presenter
{
    public function getContent()
    {
        return \Cache::remember('pages.'.$this->model->id.'.content', 10, function(){
            return MarkdownParser::parse($this->model->content);
        });
    }
}