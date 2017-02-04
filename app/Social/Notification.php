<?php

namespace PN\Social;

use Illuminate\Database\Eloquent\Model;
use PN\Users\User;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('user_id', 'type', 'context', 'read');
    protected $visible = array('user_id', 'type', 'context', 'read');

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUser() : User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user_id = $user->id;
    }

    public function getNotification()
    {
        $type = $this->type;

        return new $type($this);
    }
}
