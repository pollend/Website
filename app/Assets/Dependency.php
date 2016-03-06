<?php

namespace PN\Assets;

use Illuminate\Database\Eloquent\Model;

class Dependency extends Model
{

    protected $table = 'asset_dependencies';
    public $timestamps = false;
    protected $fillable = array('asset_id', 'dependency_id');
    protected $visible = array('asset_id', 'dependency_id');

    public function asset()
    {
        return $this->belongsTo(\PN\Assets\Asset::class);
    }

    public function dependency()
    {
        return $this->belongsTo(\PN\Assets\Asset::class, 'asset_id');
    }

}
