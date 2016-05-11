<?php


namespace PN\Foundation;


use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';
    public $timestamps = true;

    protected $fillable = array(
        'value',
    );

    protected $visible = array(
        'key',
        'value',
    );
}