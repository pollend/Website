<?php

namespace PN\BuildOffs;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use PN\Assets\Asset;
use PN\BuildOffs\Exceptions\BuildOffHasNoWinnerException;
use PN\Foundation\Presenters\PresenterTrait;

class BuildOff extends Model
{
    use PresenterTrait;

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
        return $this->hasMany(\PN\BuildOffs\Rank::class, 'buildoff_id');
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

    public function isOpen()
    {
        $start = new Carbon($this->start);
        $end = new Carbon($this->end);
        $now = new Carbon();

        return $now->gt($start) && $now->lt($end);
    }

    public function canVote()
    {
        $start = new Carbon($this->voting_start);
        $now = new Carbon();

        return $now->gt($start);
    }

    public function getWinner()
    {
        $winner = $this->getRanks()->first();

        if($winner) {
            return $winner;
        }

        throw new BuildOffHasNoWinnerException($this->id);
    }

    public function wasPreviouslyRanked()
    {
        return $this->getRanks()->count() > 0;
    }

    /**
     * Checks if given asset may participate in this buildoff
     * @param Asset $asset
     * @return bool
     */
    public function eligible(Asset $asset)
    {
        if(!empty($this->type_requirement) && $asset->type != $this->type_requirement) {
            return false;
        }

        if($this->tag_id != null) {
            foreach ($asset->getTags() as $tag) {
                if($tag->id == $this->tag_id) {
                    return true;
                }
            }

            return false;
        }

        return true;
    }
}
