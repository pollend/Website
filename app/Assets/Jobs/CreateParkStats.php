<?php

namespace PN\Assets\Jobs;


use PN\Assets\Stats\AssetStat;
use PN\Assets\Stats\Stat;
use PN\Jobs\Job;

class CreateParkStats extends Job
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
        $parkStats = \ResourceUtil::makeExtractor($this->asset->resource)->getData()['Park']['ParkInfo'];

        foreach ($parkStats as $key => $value) {
            $stat = Stat::where('name', $key)->first();

            if($stat != null) {
                AssetStat::create([
                    'asset_id' => $this->asset->id,
                    'stat_id' => $stat->id,
                    'value' => $value
                ]);
            }
        }
    }
}
