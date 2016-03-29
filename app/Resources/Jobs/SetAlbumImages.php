<?php

namespace PN\Resources\Jobs;


use PN\Jobs\Job;
use PN\Resources\Image;

class SetAlbumImages extends Job
{
    /**
     * @var \PN\Resources\Album
     */
    private $album;

    /**
     * @var \PN\Resources\Image[]
     */
    private $rawImages;

    /**
     * SetAlbumImages constructor.
     * @param $album
     * @param $rawImages
     */
    public function __construct($album, $rawImages)
    {
        $this->album = $album;
        $this->rawImages = $rawImages;
    }

    public function handle()
    {
        $images = [];

        foreach ($this->rawImages as $rawImage) {
            $image = Image::make($rawImage);
            $image->save();

            $images[] = $image;
        }

        $this->album->setImages($images);
    }
}
