<?php

namespace PN\Social;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('user_id', 'title', 'read');
    protected $visible = array('user_id', 'title', 'read');

}
