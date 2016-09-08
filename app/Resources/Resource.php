<?php
namespace PN\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use PN\Assets\Repositories\TagRepositoryInterface;
use PN\Foundation\Presenters\Presenter;
use PN\Foundation\Presenters\PresenterTrait;
use PN\Media\Image;
use PN\Resources\Exceptions\InvalidResource;
use PN\Resources\Extractors\ExtractorInterface;
use PN\Resources\Stats\ResourceStat;
use PN\Resources\Validators\ValidatorInterface;


class Resource extends Model implements ResourceInterface
{
    protected $table = 'resources';
    public $timestamps = true;

    use SoftDeletes, PresenterTrait;

    protected $dates = ['deleted_at'];
    protected $fillable = array('image_id', 'source', 'type');
    protected $visible = array('image_id', 'source', 'type');
    private $data;

    private $strategy;

    public static function boot()
    {
        parent::boot();

        self::saving(function($resource){
            if(!$resource->type) {
                $resource->type = $resource->getType();
            }
        });
    }

    protected function stats()
    {
        return $this->hasMany(ResourceStat::class);
    }

    public function getStrategy() : ResourceInterface
    {
        if(!$this->strategy) {
            if(!$this->type) {
                $this->type = $this->getType();
            }

            $strategy = null;

            switch ($this->type) {
                case 'mod':
                    $strategy = new ModStrategy($this);
                    break;
                case 'blueprint':
                    $strategy = new BlueprintStrategy($this);
                    break;
                case 'park':
                    $strategy = new ParkStrategy($this);
                    break;
            }

            $this->strategy = $strategy;
        }

        return $this->strategy;
    }

    public function getType() : string
    {
        if (preg_match('/http(s?):\/\/github.com\/([a-zA-Z0-9-_]+)\/([a-zA-Z0-9-_]+)(\/?)/', $this->source) == 1) {
            return 'mod';
        }

        switch (pathinfo($this->source, PATHINFO_EXTENSION)) {
            case 'png':
                return 'blueprint';
            case 'txt': // to support old parks
                return 'park';
            case 'scenario':
            case 'park':
                return 'park';
        }

        throw new InvalidResource($this);
    }

    public function image()
    {
        return $this->belongsTo(\PN\Media\Image::class);
    }

    public function asset()
    {
        return $this->hasOne(\PN\Assets\Asset::class);
    }

    public function getAsset()
    {
        return $this->asset;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image_id = $image->id;
    }

    public function setSource($source)
    {
        $this->source = $source;
        $this->getStrategy()->setSource($source);
    }

    public function setDefaultImage()
    {
        $this->getStrategy()->setDefaultImage();
    }

    public function getPrimaryTags() : Collection
    {
        return $this->getStrategy()->getPrimaryTags();
    }

    public function getExtractor() : ExtractorInterface
    {
        return $this->getStrategy()->getExtractor();
    }

    public function getValidator() : ValidatorInterface
    {
        return $this->getStrategy()->getValidator();
    }

    public function getPresenter() : Presenter
    {
        return $this->getStrategy()->getPresenter();
    }

    public function getStats() : array
    {
        return $this->getStrategy()->getStats();
    }

}
