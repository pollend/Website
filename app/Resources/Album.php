<?php

namespace PN\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PN\Media\Image;

class Album extends Model
{

    protected $table = 'albums';
    public $timestamps = false;

    public function images()
    {
        return $this->belongsToMany(Image::class, 'resource_album_images', 'album_id', 'image_id');
    }

    public function setImages($images)
    {
        $images = new Collection($images);

        $this->images()->sync($images->pluck('id')->toArray());
    }
}
