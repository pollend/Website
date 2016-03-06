<?php

namespace PN\Assets\Stats;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{

    protected $table = 'stats';
    public $timestamps = false;
    protected $fillable = array('name', 'title');
    protected $visible = array('name', 'title');

}
