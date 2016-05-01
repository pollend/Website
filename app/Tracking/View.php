<?php

namespace PN\Tracking;

use Illuminate\Database\Eloquent\Model;
use PN\Users\User;

class View extends Model
{

    protected $table = 'views';
    public $timestamps = true;
    protected $fillable = array('user_id', 'viewable_id', 'viewable_type', 'ip');
    protected $visible = array('user_id', 'viewable_id', 'viewable_type', 'ip');

    public function viewable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function getViewable()
    {
        return $this->viewable;
    }

    public function setViewable($viewable)
    {
        $this->viewable_id = $viewable->id;
        $this->viewable_type = get_class($viewable);
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
