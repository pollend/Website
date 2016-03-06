<?php

namespace PN\Resources;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'resource_images';
    public $timestamps = false;
    protected $fillable = array('source');
    protected $visible = array('source');

    /**
     * Fills this source with imagedata
     *
     * @param $imageData
     * @param string $extension
     * @return Image
     */
    public static function make($imageData, $extension = 'jpg')
    {
        $image = new Image();

        $path = 'images/' . sha1(uniqid()) . '.' . $extension;

        \Storage::disk()->put($path, $imageData);

        $image->source = $path;

        return $image;
    }

    /**
     * Returns the binary image data of this image
     *
     * @return string
     */
    public function getRaw()
    {
        return \Storage::disk()->get($this->source);
    }
}
