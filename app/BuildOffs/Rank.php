<?php

namespace PN\BuildOffs;

use Illuminate\Database\Eloquent\Model;
use PN\Assets\Asset;

class Rank extends Model
{

    protected $table = 'buildoff_ranks';
    public $timestamps = false;
    protected $fillable = array('asset_id', 'buildoff_id', 'score', 'rank');
    protected $visible = array('asset_id', 'buildoff_id', 'score', 'rank');

    public function asset()
    {
        return $this->belongsTo(\PN\Assets\Asset::class);
    }

    public function buildOff()
    {
        return $this->belongsTo(BuildOff::class);
    }

    public function getAsset()
    {
        return $this->asset;
    }

    public function setAsset(Asset $asset)
    {
        $this->asset_id = $asset->id;
    }

    public function getBuildOff()
    {
        return $this->buildOff;
    }

    public function setBuildOff(BuildOff $buildOff)
    {
        return $this->buildoff_id = $buildOff->id;
    }
}
