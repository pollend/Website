<?php


namespace PN\Pages;


use Illuminate\Database\Eloquent\Model;
use PN\Foundation\Presenters\PresenterTrait;

class Page extends Model
{
    use PresenterTrait;
    
    protected $table = 'pages';
    public $timestamps = false;
    protected $fillable = array(
        'title',
        'slug',
        'content'
    );
    protected $visible = array(
        'id',
        'title',
        'slug',
        'content'
    );
}