<?php

namespace PN\Resources;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Resources\Jobs\ResizeImage;

class ImageObserver
{
    use DispatchesJobs;

    public function saved($image)
    {
        $this->dispatch(app(ResizeImage::class, [$image]));
    }
}
