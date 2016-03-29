<?php

namespace PN\Assets\Jobs;


use PN\Jobs\Job;

class CreateStats extends Job
{
    private $asset;

    /**
     * CreateStats constructor.
     * @param $asset
     */
    public function __construct($asset)
    {
        $this->asset = $asset;
    }

    public function handle()
    {
        switch($this->asset->type) {
            case 'blueprint':
                return $this->dispatch(app(CreateBlueprintStats::class, [$this->asset]));
            case 'park':
                return $this->dispatch(app(CreateParkStats::class, [$this->asset]));
            default:
                return null;
        }
    }
}
