<?php

namespace PN\Assets\Jobs;


use PN\Assets\Asset;
use PN\Jobs\Job;
use PN\Resources\Album;
use PN\Resources\Image;

class CreateAsset extends Job
{
    private $resource;

    private $user;

    private $name;

    private $description;

    /**
     * CreateAsset constructor.
     * @param $resource
     * @param $user
     * @param $name
     * @param $description
     */
    public function __construct($resource, $user, $name, $description)
    {
        $this->resource = $resource;
        $this->user = $user;
        $this->name = $name;
        $this->description = $description;
    }

    public function handle()
    {
        $album = Album::create();
        $image = Image::make($this->resource->image->getRaw());
        $image->save();

        $asset = new Asset();
        $asset->setResource($this->resource);
        $asset->setUser($this->user);
        $asset->setAlbum($album);
        $asset->setImage($image);

        $asset->type = \ResourceUtil::getTypeOf($this->resource);
        $asset->name = $this->name;
        $asset->description = $this->description;

        $asset->save();

        return $asset;
    }
}
