<?php

namespace PN\Social\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    protected $table = 'forum_posts';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('thread_id', 'user_id', 'content', 'post_id');
    protected $visible = array('thread_id', 'user_id', 'content', 'post_id');

    public function attachments()
    {
        return $this->hasMany(\PN\Social\Forum\Attachment::class);
    }

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function thread()
    {
        return $this->belongsTo(\PN\Social\Forum\Thread::class);
    }

}
