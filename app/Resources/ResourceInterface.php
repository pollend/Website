<?php


namespace PN\Resources;


use Illuminate\Support\Collection;
use PN\Foundation\Presenters\Presenter;
use PN\Resources\Extractors\ExtractorInterface;
use PN\Resources\Validators\ValidatorInterface;

interface ResourceInterface
{
    public function getPresenter() : Presenter;

    public function setSource($source);

    public function setDefaultImage();

    public function getPrimaryTags() : Collection;

    public function getExtractor() : ExtractorInterface;

    public function getValidator() : ValidatorInterface;

    public function getStats() : array;
}