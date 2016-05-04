<?php


namespace PN\Media\Jobs;


use PN\Jobs\Job;
use PN\Media\Image;

class CreateImageFromRaw extends Job
{
    private $imageData;

    private $extension;

    /**
     * CreateImage constructor.
     * @param $imageData
     * @param $extension
     */
    public function __construct($imageData, $extension = 'jpg')
    {
        $this->imageData = $imageData;
        $this->extension = $extension;
    }

    public function handle()
    {
        return Image::createFromData($this->imageData, $this->extension);
    }
}