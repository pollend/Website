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

    private function tag()
    {
        return $this->belongsTo(\PN\Assets\Tag::class);
    }

    private function ranks()
    {
        return $this->hasMany(\PN\BuildOffs\Rank::class);
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTag($tag)
    {
        return $this->tag_id = $tag->id;
    }

    public function getRanks()
    {
        return $this->ranks;
    }

    public function setRanks($ranks)
    {
        $this->ranks()->sync($ranks->lists('id'));
    }

    public function addRank($rank)
    {
        $rank->setBuildOff($this);
    }
}
