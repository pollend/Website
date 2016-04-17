<?php

namespace PN\Media\Jobs;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use PN\Jobs\Job;

class ResizeImage extends Job implements ShouldQueue
{
    use SerializesModels;

    /**
     * @var \PN\Media\Image
     */
    private $image;

    /**
     * ResizeImage constructor.
     * @param $image
     */
    public function __construct($image)
    {
        $this->image = $image;
    }

    public function handle()
    {
        foreach(config('images.sizes') as $size) {
            $width = $size[0];
            $height = $size[1];
            $aspect = $size[2];

            $resized = \Image::make($this->image->getRaw())->resize($width, $height, function($constraint) use ($aspect) {
                if($aspect) {
                    $constraint->aspectRatio();
                }
                $constraint->upsize();
            });

            \Storage::disk('images')->put("{$width}x{$height}/{$this->image->source}", $resized->encode('jpg', 100)->__toString());
        }
    }
}
