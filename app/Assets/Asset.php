<?php
namespace PN\Assets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PN\Assets\Events\TagWasDetachedFromAsset;
use PN\Resources\Stats\ResourceStat;
use PN\Resources\Stats\Stat;
use PN\Assets\Stats\StatInterface;
use PN\BuildOffs\Rank;
use PN\Foundation\Presenters\PresenterTrait;
use PN\Resources\Album;
use PN\Media\Image;
use PN\Resources\Resource;
use PN\Resources\ResourceInterface;
use PN\Social\Comment;
use PN\Tracking\View;
use PN\Users\User;


class Asset extends Model
{
    protected $table = 'assets';
    public $timestamps = true;

    use SoftDeletes, PresenterTrait;

    protected $dates = ['deleted_at'];
    protected $guarded = array('user_id');
    protected $fillable = array(
        'image_id',
        'album_id',
        'buildoff_id',
        'resource_id',
        'resource_type',
        'identifier',
        'name',
        'slug',
        'description',
        'youtube',
        'hot_score',
        'likes',
        'views',
        'downloads'
    );
    protected $visible = array(
        'user_id',
        'image_id',
        'album_id',
        'buildoff_id',
        'resource_id',
        'resource_type',
        'identifier',
        'name',
        'slug',
        'description',
        'youtube',
        'hot_score',
        'likes',
        'views',
        'downloads'
    );

    public static function boot()
    {
        parent::boot();

        Asset::creating(function ($asset) {
            $asset->identifier = substr(sha1(uniqid()), 0, 10);
        });
    }

    protected function tags()
    {
        return $this->belongsToMany(\PN\Assets\Tag::class, 'asset_tags');
    }

    protected function dependencies()
    {
        return $this->belongsToMany(\PN\Assets\Asset::class, 'asset_dependencies', 'asset_id', 'dependency_id', 'id');
    }

    protected function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    protected function image()
    {
        return $this->belongsTo(\PN\Media\Image::class);
    }

    protected function buildOff()
    {
        return $this->belongsTo(\PN\BuildOffs\BuildOff::class, 'buildoff_id');
    }

    protected function images()
    {
        return $this->belongsToMany(Image::class, 'asset_images');
    }

    protected function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    protected function downloads()
    {
        return $this->morphedByMany(\PN\Tracking\Download::class, 'downloadable');
    }

    protected function views()
    {
        return $this->morphedByMany(View::class, 'viewable');
    }

    protected function rank()
    {
        return $this->hasOne(Rank::class);
    }

    protected function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getImage()
    {
        return \Cache::remember('images.'.$this->image_id, 3600, function() {
            return $this->image;
        });
    }

    public function setImage(Image $image)
    {
        $this->image_id = $image->id;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages(Collection $images)
    {
        $this->images()->sync($images->pluck('id')->toArray());
    }

    public function addImage(Image $image)
    {
        $this->images()->attach($image->id, ['asset_id' => $this->id]);
    }

    public function removeImage($image)
    {
        $this->images()->detach($image->id);
    }

    public function getResource()
    {
        return \Cache::remember('resource.'.$this->resource_id, 3600, function(){
            return $this->resource()->first();
        });
    }

    public function setResource($resource)
    {
        $this->resource_id = $resource->id;

        \Cache::put('resource.'.$resource->id, $resource, 3600);
    }

    public function getUser()
    {
        return \Cache::remember('user.'.$this->user_id, 3600, function(){
            return $this->user;
        });
    }

    public function setUser(User $user)
    {
        $this->user_id = $user->id;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $ids = [];

        foreach ($tags as $tag) {
            $ids[] = $tag->id;
        }

        $this->tags()->sync($ids);
    }

    public function addTag(Tag $tag)
    {
        $this->tags()->attach($tag->id);
    }

    public function removeTag(Tag $tag)
    {
        $this->tags()->detach($tag->id);
    }

    public function hasTag($tag)
    {
        return $this->tags()->find($tag->id) != null;
    }
    
    public function getBuildOff()
    {
        return $this->buildOff;
    }

    public function setBuildOff($buildOff)
    {
        $this->buildoff_id = $buildOff->id;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function addComment($comment)
    {
        $comment->setAsset($this);
    }

    public function getDependencies()
    {
        return $this->dependencies;
    }

    public function isDependency($dependency)
    {
        $dependencies = $this->dependencies;

        foreach ($dependencies as $dep) {
            if($dependency->id == $dep->id) {
                return true;
            }
        }

        return false;
    }

    public function addDependency($dependency)
    {
        $this->dependencies()->attach($dependency->id);
    }

    public function removeDependency($dependency)
    {
        $this->dependencies()->detach($dependency->id);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->slug = Str::slug($name);
    }
}
