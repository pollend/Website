<?php


namespace PN\Resources;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;
use PN\Foundation\Presenters\Presenter;
use PN\Foundation\StorageUtil;
use PN\Media\Jobs\CreateImageFromRaw;
use PN\Resources\Extractors\ExtractorInterface;
use PN\Resources\Extractors\ParkExtractor;
use PN\Resources\Validators\ParkValidator;
use PN\Resources\Validators\ValidatorInterface;

class ParkStrategy extends ResourceStrategy implements ResourceInterface
{
    use DispatchesJobs;

    public function getPresenter() : Presenter
    {
        return new ParkPresenter($this->resource);
    }

    public function setDefaultImage()
    {
        $extractor = $this->getExtractor();

        $raw = base64_decode($extractor->getData()['Header']['Screenshot']);

        $resizedRaw = \Image::make($raw)
            ->resize(512, 512)
            ->encode('jpg', 100);

        $image = $this->dispatch(new CreateImageFromRaw($resizedRaw));

        $this->resource->setImage($image);
    }

    public function setSource($source)
    {
        // is source local? make it remote
        if (\File::exists($source)) {
            $remoteSource = basename($source);

            \Storage::disk('parks')->put($remoteSource, file_get_contents($source));

            $source = $remoteSource;
        }

        $this->resource->source = $source;
    }

    public function getPrimaryTags() : Collection
    {
        if(ends_with($this->resource->source, '.scenario')) {
            return new Collection([
                'Scenario'
            ]);
        }

        return new Collection([]);
    }

    public function getExtractor() : ExtractorInterface
    {
        $resource = $this->resource;

        return new ParkExtractor(StorageUtil::copyToTmp('parks', $this->resource->source));
    }

    public function getValidator() : ValidatorInterface
    {
        $resource = $this->resource;

        return new ParkValidator(StorageUtil::copyToTmp('parks', $this->resource->source));
    }

    public function getStats() : array
    {
        $resource = $this->resource;
        return \Cache::remember("resource.{$this->resource->id}.stats", 1440, function() use ($resource) {
            $stats = [];

            foreach($resource->stats as $stat) {
                $stats[$stat->getStat()->name] = [
                    'title' => $stat->getStat()->title,
                    'value' => $stat->value
                ];
            }

            return $stats;
        });
    }
}