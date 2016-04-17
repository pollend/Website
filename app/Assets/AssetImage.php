<?php

namespace PN\Assets;

use Illuminate\Database\Eloquent\Model;

class AssetImage extends Model
{
    protected $table = 'asset_images';
    public $timestamps = false;
    protected $fillable = array('asset_id', 'image_id');
    protected $visible = array('asset_id', 'image_id');

}
