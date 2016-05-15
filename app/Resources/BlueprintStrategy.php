<?php


namespace PN\Resources;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use PN\Foundation\Presenters\Presenter;
use PN\Foundation\StorageUtil;
use PN\Media\Jobs\CreateImageFromRaw;
use PN\Resources\Extractors\BlueprintExtractor;
use PN\Resources\Extractors\ExtractorInterface;
use PN\Resources\Validators\BlueprintValidator;
use PN\Resources\Validators\ValidatorInterface;

class BlueprintStrategy extends ResourceStrategy implements ResourceInterface
{
    use DispatchesJobs;

    private $data;

    public function getPresenter() : Presenter
    {
        return new BlueprintPresenter($this->resource);
    }

    public function setDefaultImage()
    {
        $raw = \Storage::disk('blueprints')->get($this->resource->source);

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

            \Storage::disk('blueprints')->put($remoteSource, file_get_contents($source));

            $source = $remoteSource;
        }

        $this->resource->source = $source;
    }

    private function retrieveData()
    {
        if($this->data == null) {
            $this->data = $this->getExtractor()->getData();
        }
    }

    public function getPrimaryTags() : Collection
    {
        $this->retrieveData();

        $types = new Collection([]);

        if($this->hasScenery()) {
            $types->push('HasScenery');
        }

        if($this->hasFlatRides()) {
            $types->push('HasFlatRide');
        }

        if($this->hasCoaster()) {
            $types->push('HasCoaster');
        }

        if($this->hasMods()) {
            $types->push('HasMods');
        }

        if($this->isCoaster()) {
            $types->push('RollerCoaster');
            $types->push($this->getCoaster());
        }

        if($this->hasScenery() && !$this->hasFlatRides() && !$this->hasCoaster()) {
            $types->push('HasOnlyScenery');
        }

        return $types;
    }

    private function hasScenery()
    {
        $this->retrieveData();

        return isset($this->data['Header']['DecoTypes']) && count($this->data['Header']['DecoTypes']) > 0;
    }

    private function hasFlatRides()
    {
        $this->retrieveData();

        return count($this->data['Header']['FlatRideTypes']) > 0;
    }

    private function hasCoaster()
    {
        $this->retrieveData();

        return count($this->data['Header']['TrackedRideTypes']) > 0;
    }

    private function hasMods()
    {
        $this->retrieveData();

        return count($this->data['Header']['ActiveMods']) > 0;
    }

    public function isCoaster()
    {
        $this->retrieveData();

        return count($this->data['Header']['TrackedRideTypes']) == 1 && count($this->data['Header']['FlatRideTypes']) == 0;
    }

    public function getCoaster()
    {
        $this->retrieveData();

        return $this->data['Header']['TrackedRideTypes'][0];
    }

    public function getExtractor() : ExtractorInterface
    {
        $resource = $this->resource;

        return new BlueprintExtractor(StorageUtil::copyToTmp('blueprints', $resource->source));
    }

    public function getValidator() : ValidatorInterface
    {
        $resource = $this->resource;

        return new BlueprintValidator(StorageUtil::copyToTmp('blueprints', $resource->source));
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