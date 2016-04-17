<?php

namespace PN\Media;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Media\Jobs\ResizeImage;

class ImageObserver
{
    use DispatchesJobs;

    public function saved($image)
    {
        $this->dispatch(new ResizeImage($image));
    }
}
