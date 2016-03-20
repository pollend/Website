<?php
namespace PN\Assets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use PN\Assets\Stats\AssetStat;
use PN\Assets\Stats\Stat;
use PN\Assets\Stats\StatInterface;
use PN\BuildOffs\Rank;
use PN\Foundation\Presenters\PresenterTrait;
use PN\Resources\Album;
use PN\Resources\Image;
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
        parent::boot(); // TODO: Change the autogenerated stub

        Asset::creating(function ($asset) {
            $asset->identifier = substr(sha1(uniqid()), 0, 10);
        });
    }

    public function tags()
    {
        return $this->belongsToMany(\PN\Assets\Tag::class, 'asset_tags');
    }

    public function dependencies()
    {
        return $this->hasManyThrough(\PN\Assets\Asset::class, \PN\Assets\AssetDependency::class);
    }

    public function user()
    {
        return $this->belongsTo(\PN\Users\User::class);
    }

    public function image()
    {
        return $this->belongsTo(\PN\Resources\Image::class);
    }

    public function buildOff()
    {
        return $this->belongsTo(\PN\BuildOffs\BuildOff::class);
    }

    public function album()
    {
        return $this->belongsTo(\PN\Resources\Album::class);
    }

    public function resource()
    {
        return $this->morphTo();
    }

    public function downloads()
    {
        return $this->morphedByMany(\PN\Tracking\Download::class, 'downloadable');
    }

    public function views()
    {
        return $this->morphedByMany(View::class, 'viewable');
    }

    public function stats()
    {
        return $this->hasMany(AssetStat::class);
    }

    public function rank()
    {
        return $this->hasOne(Rank::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function setImage(Image $image)
    {
        $this->image_id = $image->id;
    }

    public function setAlbum(Album $album)
    {
        $this->album_id = $album->id;
    }

    public function setResource(ResourceInterface $resource)
    {
        $this->resource_id = $resource->id;
        $this->resource_type = get_class($resource);
    }

    public function setUser(User $user)
    {
        $this->user_id = $user->id;
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->slug = Str::slug($name);
    }

    public function getStats()
    {
        $asset = $this;
        return \Cache::remember('asset.stats', 1440, function() use ($asset) {
            $stats = [];

            foreach($asset->stats as $stat) {
                $stats[$stat->stat->name] = [
                    'title' => $stat->stat->title,
                    'value' => $stat->value
                ];
            }

            return $stats;
        });
    }
}
