<?php

namespace PN\Media\Jobs;


use PN\Jobs\Job;
use PN\Media\Image;

class ResizeImage extends Job
{
    /**
     * @var \PN\Media\Image
     */
    private $image;

    /**
     * ResizeImage constructor.
     * @param $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function handle()
    {
        foreach(config('images.sizes') as $size) {
            $width = $size[0];
            $height = $size[1];
            $aspect = $size[2];

            $method = $width == $height ? 'fit' : 'resize';

            $resized = \Image::make($this->image->getRaw())->$method($width, $height, function($constraint) use ($aspect) {
                if($aspect) {
                    $constraint->aspectRatio();
                }
                $constraint->upsize();
            });

            \Storage::disk('images')->put("{$width}x{$height}/{$this->image->source}", $resized->encode('jpg', 100)->__toString());

            $resized->destroy();
        }
    }
}
