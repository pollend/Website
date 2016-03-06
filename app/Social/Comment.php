<?php

namespace PN\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    protected $table = 'comments';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('asset_id', 'user_id', 'body');
    protected $visible = array('asset_id', 'user_id', 'body');

}
