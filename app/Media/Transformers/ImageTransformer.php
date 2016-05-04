<?php


namespace PN\Media\Transformers;


use League\Fractal\TransformerAbstract;
use PN\Media\Image;

class ImageTransformer extends TransformerAbstract
{
    public function transform(Image $image)
    {
        return [
            'source' => $image->source,
            'url' => $image->getPresenter()->source()
        ];
    }
}