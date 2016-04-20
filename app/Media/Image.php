<?php

namespace PN\Media;


use Illuminate\Database\Eloquent\Model;
use PN\Foundation\Presenters\PresenterTrait;

class Image extends Model
{
    use PresenterTrait;

    protected $table = 'images';
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
    public static function createFromData($imageData, $extension = 'jpg')
    {
        $image = new Image();

        $path = sha1(uniqid()) . '.' . $extension;

        \Storage::disk('images')->put($path, $imageData);

        $image->source = $path;

        \ImageRepo::add($image);

        return $image;
    }

    /**
     * Returns the binary image data of this image
     *
     * @return string
     */
    public function getRaw()
    {
        return \Storage::disk('images')->get($this->source);
    }
}
