<?php

namespace PN\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screenshot extends Model
{

    protected $table = 'screenshots';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('identifier');
    protected $fillable = array('user_id', 'image_id', 'title');
    protected $visible = array('user_id', 'image_id', 'identifier', 'title');

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function image()
    {
        return $this->belongsTo(\PN\Resources\Image::class);
    }

}
