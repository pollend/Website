<?php


namespace PN\Resources;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use PN\Foundation\Presenters\Presenter;
use PN\Media\Jobs\CreateImageFromRaw;
use PN\Resources\Extractors\ExtractorInterface;
use PN\Resources\Extractors\ModExtractor;
use PN\Resources\Validators\ModValidator;
use PN\Resources\Validators\ValidatorInterface;

class ModStrategy extends ResourceStrategy implements ResourceInterface
{
    use DispatchesJobs;

    public function getPresenter() : Presenter
    {
        return new ModPresenter($this->resource);
    }

    public function setDefaultImage()
    {
        $raw = file_get_contents(public_path('img/wrench.jpg'));

        $resizedRaw = \Image::make($raw)
            ->resize(512,
            512)->encode('jpg', 100);

        $image = $this->dispatch(new CreateImageFromRaw($resizedRaw));

        $this->resource->setImage($image);
    }

    public function setSource($source)
    {
        $this->resource->source = $source;
    }

    public function getPrimaryTags() : Collection
    {
        return new Collection([]);
    }

    public function getExtractor() : ExtractorInterface
    {
        return new ModExtractor($this->resource->source);
    }

    public function getValidator() : ValidatorInterface
    {
        return new ModValidator($this->resource->source);
    }

    public function getStats() : array
    {
        return [];
    }
}