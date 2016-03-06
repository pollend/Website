<?php

namespace PN\Social;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $table = 'likes';
    public $timestamps = true;
    protected $fillable = array('user_id', 'likeable_id', 'likeable_type', 'weight');
    protected $visible = array('user_id', 'likeable_id', 'likeable_type', 'weight');

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

}
