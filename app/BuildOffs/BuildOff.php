<?php

namespace PN\BuildOffs;

use Illuminate\Database\Eloquent\Model;

class BuildOff extends Model
{

    protected $table = 'buildoffs';
    public $timestamps = true;
    protected $fillable = array(
        'tag_id',
        'type_requirement',
        'name',
        'short_description',
        'description',
        'thumbnail',
        'start',
        'end',
        'voting_start'
    );
    protected $visible = array(
        'tag_id',
        'type_requirement',
        'name',
        'short_description',
        'description',
        'thumbnail',
        'start',
        'end',
        'voting_start'
    );

    public function tag()
    {
        return $this->belongsTo(\PN\Assets\Tag::class);
    }

    public function ranks()
    {
        return $this->hasMany(\PN\BuildOffs\Rank::class);
    }

}
