<?php
namespace PN\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use PN\Assets\Repositories\TagRepositoryInterface;
use PN\Foundation\Presenters\PresenterTrait;


class Blueprint extends Model implements ResourceInterface
{
    protected $table = 'resource_blueprints';
    public $timestamps = true;

    use SoftDeletes, PresenterTrait;

    protected $dates = ['deleted_at'];
    protected $fillable = array('image_id', 'source');
    protected $visible = array('image_id', 'source');
    private $data;

    public function image()
    {
        return $this->belongsTo(\PN\Resources\Image::class);
    }

    public function asset()
    {
        return $this->morphOne(\PN\Assets\Asset::class, 'resource');
    }

    private function setImage($image)
    {
        $this->image_id = $image->id;
    }

    public function setSourceAttribute($source)
    {
        // is source local? make it remote
        if (\File::exists($source)) {
            $remoteSource = basename($source);

            \Storage::disk('blueprints')->put($remoteSource, file_get_contents($source));

            $source = $remoteSource;
        }

        $this->attributes['source'] = $source;
    }

    public function overwriteImageWithDefault()
    {
        /**
         * Load park from storage to local to parse
         */
        $image = Image::make(\Image::make(\Storage::disk('blueprints')->get($this->source))->resize(512, 512)->encode('jpg',
            100));

        $image->save();

        $this->setImage($image);
    }

    public function getType()
    {
        return 'blueprint';
    }

    public function getPrimaryTags()
    {
        $this->data = \ResourceUtil::makeExtractor($this)->getData();

        $types = new Collection([]);

        if($this->hasScenery()) {
            $types->push('HasScenery');
        }

        if($this->hasFlatRides()) {
            $types->push('HasFlatRide');
        }

        if($this->hasCoaster()) {
            $types->push('HasCoaster');
        }

        if($this->isCoaster()) {
            $types->push('RollerCoaster');
            $types->push($this->getCoaster());
        }

        if($this->hasScenery() && !$this->hasFlatRides() && !$this->hasCoaster()) {
            $types->push('HasOnlyScenery');
        }

        return $types;
    }

    private function hasScenery()
    {
        return count($this->data['Header']['DecoTypes']) > 0;
    }

    private function hasFlatRides()
    {
        return count($this->data['Header']['FlatRideTypes']) > 0;
    }

    private function hasCoaster()
    {
        return count($this->data['Header']['TrackedRideTypes']) > 0 || $this->data['Header']['ContentType'] != null;
    }

    public function isCoaster()
    {
        return count($this->data['Header']['TrackedRideTypes']) == 1 || $this->data['Header']['ContentType'] != null;
    }

    public function getCoaster()
    {
        if($this->data['Header']['ContentType'] != null) {
            return $this->data['Header']['ContentType'];
        }

        return $this->data['Header']['TrackedRideTypes'][0];
    }
}
