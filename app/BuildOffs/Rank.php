<?php

namespace PN\BuildOffs;

use Illuminate\Database\Eloquent\Model;

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

}
