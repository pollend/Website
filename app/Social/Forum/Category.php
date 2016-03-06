<?php

namespace PN\Social\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $table = 'forum_categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('category_id', 'title', 'description', 'weight', 'enable_threads', 'private');
    protected $visible = array('category_id', 'title', 'description', 'weight', 'enable_threads', 'private');

    public function parent()
    {
        return $this->belongsTo(\PN\Social\Forum\Category::class);
    }

    public function threads()
    {
        return $this->hasMany(\PN\Social\Forum\Thread::class);
    }

}
