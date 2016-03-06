<?php

namespace PN\Social\Forum;

use Illuminate\Database\Eloquent\Model;

class Read extends Model
{

    protected $table = 'forum_thread_reads';
    public $timestamps = true;
    protected $fillable = array('thread_id', 'user_id');
    protected $visible = array('thread_id', 'user_id');

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function thread()
    {
        return $this->belongsTo(\PN\Social\Forum\Thread::class);
    }

}
