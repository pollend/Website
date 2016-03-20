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
        $tagRepo = app(TagRepositoryInterface::class);

        $data = \ResourceUtil::makeExtractor($this)->getData();

        $types = new Collection([$this->getType()]);

        foreach (\Config::get('backend.blueprint-types') as $tagType => $blueprintTypes) {
            foreach ($blueprintTypes as $blueprintType) {
                if ($blueprintType == $data['Header']['ContentType']) {
                    $types->push($tagType);
                }
            }
        }

        return $types;
    }
}
