<?php


namespace PN\Client;


use Illuminate\Database\Eloquent\Model;

class ClientLog extends Model
{
    protected $table = 'client_log';
    public $timestamps = true;

    protected $fillable = array('ip', 'action', 'version');

}