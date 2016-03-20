<?php
namespace PN\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PN\Foundation\Presenters\PresenterTrait;


class Mod extends Model implements ResourceInterface
{
    protected $table = 'resource_mods';
    public $timestamps = true;

    use SoftDeletes, PresenterTrait;

    protected $dates = ['deleted_at'];
    protected $fillable = array('image_id', 'source');
    protected $visible = array('image_id', 'source');

    public function image()
    {
        return $this->belongsTo(\PN\Resources\Image::class);
    }

    public function asset()
    {
        return $this->morphOne(\PN\Assets\Asset::class, 'resource');
    }

    public function setImage($image)
    {
        $this->image_id = $image->id;
    }

    public function overwriteImageWithDefault()
    {
        /**
         * Load park from storage to local to parse
         */
        $image = Image::make(\Image::make(file_get_contents(public_path('img/wrench.jpg')))->resize(512,
            512)->encode('jpg', 100));

        $image->save();

        $this->setImage($image);
    }

    public function getType()
    {
        return 'mod';
    }
}
