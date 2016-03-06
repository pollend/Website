<?php

namespace PN\Tracking;

use Illuminate\Database\Eloquent\Model;

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

}
