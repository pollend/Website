<?php

namespace PN\Social;

use Illuminate\Database\Eloquent\Model;
use PN\Users\User;

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

    public function getLikeable()
    {
        return $this->likeable;
    }

    public function setLikeable($likeable)
    {
        $this->likeable_id = $likeable->id;
        $this->likeable_type = get_class($likeable);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user_id = $user->id;
    }

}
