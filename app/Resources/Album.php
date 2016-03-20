<?php

namespace PN\Resources;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    protected $table = 'albums';
    public $timestamps = false;

    public function images()
    {
        return $this->belongsToMany(Image::class, 'resource_album_images', 'album_id', 'image_id');
    }
}
