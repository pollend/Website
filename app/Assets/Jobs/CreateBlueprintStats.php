<?php

namespace PN\Assets\Jobs;


use Illuminate\Support\Str;
use PN\Assets\Stats\AssetStat;
use PN\Assets\Stats\Stat;
use PN\Jobs\Job;

class CreateBlueprintStats extends Job
{
    private $asset;

    /**
     * CreateBlueprintStats constructor.
     * @param $asset
     */
    public function __construct($asset)
    {
        $this->asset = $asset;
    }

    public function handle()
    {
        if (!$this->asset->resource->isCoaster()) {
            return null;
        }

        $blueprintStats = \ResourceUtil::makeExtractor($this->asset->resource)->getData()['Coaster']['Statistics'];

        foreach ($blueprintStats as $key => $value) {
            $stat = Stat::where('name', $key)->first();

            if ($stat != null) {
                AssetStat::create([
                    'asset_id' => $this->asset->id,
                    'stat_id' => $stat->id,
                    'value' => $value
                ]);
            }
        }
    }
}
