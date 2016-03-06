<?php

namespace PN\Social\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{

    protected $table = 'threads';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id', 'category_id', 'title', 'pinned', 'locked', 'views');
    protected $visible = array('user_id', 'category_id', 'title', 'pinned', 'locked', 'views');

    public function views()
    {
        return $this->morphedByMany(\PN\Tracking\View::class);
    }

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function posts()
    {
        return $this->hasMany(\PN\Social\Forum\Post::class);
    }

}
