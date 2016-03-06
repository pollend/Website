<?php

namespace PN\Assets;

use Illuminate\Database\Eloquent\Model;

class AssetTag extends Model
{

    protected $table = 'asset_tags';
    public $timestamps = false;
    protected $fillable = array('asset_id', 'tag_id');
    protected $visible = array('asset_id', 'tag_id');

}
