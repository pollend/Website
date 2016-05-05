<?php


namespace PN\Resources\Transformers;


use League\Fractal\TransformerAbstract;
use PN\Resources\Resource;

class ResourceTransformer extends TransformerAbstract
{
    public function transform(Resource $resource)
    {
        return [
            'source' => $resource->source,
            'url' => $resource->getAsset()->getPresenter()->downloadUrl()
        ];
    }
}