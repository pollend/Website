<?php


namespace PN\Resources\Transformers;


use League\Fractal\TransformerAbstract;
use PN\Resources\Resource;

class ResourceTransformer extends TransformerAbstract
{
    public function transform(Resource $resource)
    {
        $data = [
            'source' => $resource->source,
            'url' => $resource->getAsset()->getPresenter()->downloadUrl()
        ];

        if($resource->getPresenter()->isReleasable()) {
            $data['version'] = $resource->getPresenter()->getVersion();
            $data['release_date'] = $resource->getPresenter()->getReleaseDate();
        }

        return $data;
    }
}