<?php

namespace PN\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PN\Foundation\Presenters\PresenterTrait;
use PN\Users\User;

class Screenshot extends Model
{
    use PresenterTrait;
    
    protected $table = 'screenshots';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('identifier');
    protected $fillable = array('user_id', 'image_id', 'title');
    protected $visible = array('user_id', 'image_id', 'identifier', 'title');

    public static function boot()
    {
        parent::boot();

        Screenshot::creating(function ($screenshot) {
            $screenshot->identifier = substr(sha1(uniqid()), 0, 10);
        });
    }

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function image()
    {
        return $this->belongsTo(\PN\Media\Image::class);
    }

    public function getUser() : User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user_id = $user->id;
    }

    public function getImage() : Image
    {
        return $this->image;
    }

    public function setImage(Image $image)
    {
        $this->image_id = $image->id;
    }
}
