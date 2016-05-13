<?php

namespace PN\Assets;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'tags';
    public $timestamps = false;
    protected $fillable = array('type', 'tag', 'slug', 'parkitect_type', 'primary', 'category');
    protected $visible = array('type', 'tag', 'slug', 'parkitect_type', 'primary', 'category');

    private function assets()
    {
        return $this->hasManyThrough(\PN\Assets\Asset::class, \PN\Assets\AssetTag::class);
    }

    private function tags()
    {
        return $this->hasMany(\PN\BuildOffs\BuildOff::class);
    }

}
