<?php

namespace PN\Resources;

use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{

    protected $table = 'resource_album_images';
    public $timestamps = false;
    protected $fillable = array('album_id', 'image_id');
    protected $visible = array('album_id', 'image_id');

    public function album()
    {
        return $this->belongsTo(\PN\Resources\Album::class);
    }

    public function image()
    {
        return $this->belongsTo(\PN\Media\Image::class);
    }

}
