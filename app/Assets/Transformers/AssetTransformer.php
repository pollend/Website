<?php


namespace PN\Assets\Transformers;


use League\Fractal\TransformerAbstract;
use PN\Assets\Asset;
use PN\Media\Transformers\ImageTransformer;
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
        'image'
    ];

    public function transform(Asset $asset)
    {
        return [
            'identifier' => $asset->identifier,
            'name' => $asset->name,
            'description' => $asset->description,
            'image' => $asset->getImage()->source
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
}