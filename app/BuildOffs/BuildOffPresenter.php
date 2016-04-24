<?php


namespace PN\BuildOffs;


use Carbon\Carbon;
use Illuminate\Support\Str;
use PN\Foundation\Presenters\Presenter;
use PN\Social\MarkdownParser;

class BuildOffPresenter extends Presenter
{
    public function getDescription()
    {
        return \Cache::remember('buildoff.' . $this->model->id . '.description', 3600, function () {
            return MarkdownParser::parse($this->model->description);
        });
    }

    public function getSlug()
    {
        return Str::slug($this->model->name);
    }

    public function getFuzzyStart()
    {
        return (new Carbon($this->model->start))->diffForHumans();
    }

    public function getFuzzyEnd()
    {
        return (new Carbon($this->model->end))->diffForHumans();
    }

    public function getFuzzyVotingStart()
    {
        return (new Carbon($this->model->voting_start))->diffForHumans();
    }

    public function getThumbnailPath()
    {
        return "/img/buildoffs/" . $this->model->thumbnail;
    }
}