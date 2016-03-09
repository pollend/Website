<?php
namespace PN\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PN\Assets\Repositories\TagRepositoryInterface;
use PN\Foundation\Presenters\PresenterTrait;
use PN\Foundation\StorageUtil;
use PN\Resources\Extractors\ParkExtractor;


class Park extends Model implements ResourceInterface
{
    protected $table = 'resource_parks';
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

    public function setImage(Image $image)
    {
        $this->image_id = $image->id;
    }

    public function setSourceAttribute($source)
    {
        // is source local? make it remote
        if (\File::exists($source)) {
            $remoteSource = 'parks/' . basename($source);

            \Storage::disk('parks')->put($remoteSource, file_get_contents($source));

            $source = $remoteSource;
        }

        $this->attributes['source'] = $source;
    }

    /**
     * Overwrites image of this park to the default one
     */
    public function overwriteImageWithDefault()
    {
        /**
         * Load park from storage to local to parse
         */
        $data = (new ParkExtractor(StorageUtil::copyToTmp('parks', $this->source)))->getData();

        $image = Image::make(\Image::make(base64_decode($data['Header']['Screenshot']))->resize(512, 512)->encode('jpg',
            100));

        $image->save();

        $this->setImage($image);
    }

    public function getType()
    {
        return 'park';
    }

    public function getPrimaryTags()
    {
        $tagRepo = app(TagRepositoryInterface::class);

        return $tagRepo->findPrimary();
    }
}
