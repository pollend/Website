<?php

namespace PN\Tracking;

use Illuminate\Database\Eloquent\Model;

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

}
