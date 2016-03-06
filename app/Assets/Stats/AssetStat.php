<?php

namespace PN\Assets\Stats;

use Illuminate\Database\Eloquent\Model;

class AssetStat extends Model
{

    protected $table = 'asset_stats';
    public $timestamps = false;
    protected $fillable = array('asset_id', 'stat_id', 'value');
    protected $visible = array('asset_id', 'stat_id', 'value');

    public function asset()
    {
        return $this->belongsTo(\PN\Assets\Asset::class);
    }

    public function stat()
    {
        return $this->belongsTo(\PN\Assets\Stats\Stat::class);
    }

}
