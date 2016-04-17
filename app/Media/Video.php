<?php

namespace PN\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{

    protected $table = 'videos';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id', 'image_id', 'identifier', 'title');
    protected $visible = array('user_id', 'image_id', 'identifier', 'title');

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function image()
    {
        return $this->belongsTo(\PN\Media\Image::class);
    }

}
