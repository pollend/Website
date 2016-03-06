<?php

namespace PN\Social\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{

    protected $table = 'forum_attachments';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('post_id', 'filename', 'source', 'downloads');
    protected $visible = array('post_id', 'filename', 'source', 'downloads');

    public function downloads()
    {
        return $this->morphedByMany(\PN\Tracking\Download::class);
    }

    public function post()
    {
        return $this->belongsTo(\PN\Social\Forum\Post::class);
    }

}
