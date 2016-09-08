<?php


namespace PN\Assets\Transformers;


use League\Fractal\TransformerAbstract;
use PN\Assets\Asset;
use PN\Media\Transformers\ImageTransformer;
use PN\Resources\Transformers\ResourceTransformer;
use PN\Users\Transformers\UserTransformer;

class AssetTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user',
        'image',
        'resource',
        'dependencies'
    ];

    public function transform(Asset $asset)
    {
        $type = $asset->type;

        // quick hack for client
        if(ends_with($asset->getResource()->source, 'scenario')) {
            $type = 'scenario';
        }

        return [
            'type' => $type,
            'identifier' => $asset->identifier,
            'name' => $asset->name,
            'description' => $asset->description
        ];
    }

    public function includeUser(Asset $asset)
    {
        $user = $asset->getUser();

        return $this->item($user, new UserTransformer());
    }

    public function includeImage(Asset $asset)
    {
        $image = $asset->getImage();

        return $this->item($image, new ImageTransformer());
    }

    public function includeResource(Asset $asset)
    {
        $resource = $asset->getResource();

        return $this->item($resource, new ResourceTransformer());
    }

    public function includeDependencies(Asset $asset)
    {
        $dependencies = $asset->getDependencies();

        return $this->collection($dependencies, new AssetTransformer());
    }
}