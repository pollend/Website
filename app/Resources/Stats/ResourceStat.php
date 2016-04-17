<?php

namespace PN\Resources\Stats;

use Illuminate\Database\Eloquent\Model;

class ResourceStat extends Model
{
    protected $table = 'resource_stats';
    public $timestamps = false;
    protected $fillable = array('resource_id', 'stat_id', 'value');
    protected $visible = array('resource_id', 'stat_id', 'value');

    protected function resource()
    {
        return $this->belongsTo(\PN\Resources\Resource::class);
    }

    protected function stat()
    {
        return $this->belongsTo(\PN\Resources\Stats\Stat::class);
    }

    public function getStat()
    {
        return $this->stat;
    }

    public function getAsset()
    {
        return $this->asset;
    }

}
