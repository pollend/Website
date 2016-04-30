<?php

namespace PN\Tracking;

use Illuminate\Database\Eloquent\Model;
use PN\Users\User;

class Download extends Model
{

    protected $table = 'downloads';
    public $timestamps = true;
    protected $fillable = array('user_id', 'downloadable_id', 'downloadable_type', 'ip');
    protected $visible = array('user_id', 'downloadable_id', 'downloadable_type', 'ip');

    public function downloadable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function getDownloadable()
    {
        return $this->downloadable;
    }

    public function setDownloadable($downloadable)
    {
        $this->downloadable_id = $downloadable->id;
        $this->downloadable_type = get_class($downloadable);
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
