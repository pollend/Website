<?php

namespace PN\Assets\Jobs;


use PN\Assets\Asset;
use PN\Jobs\Job;
use PN\Resources\Album;
use PN\Media\Jobs\CreateImageFromRaw;
use PN\Resources\ResourceInterface;
use PN\Users\User;

/**
 * Class CreateAsset
 * @package PN\Assets\Jobs
 */
class CreateAsset extends Job
{
    /**
     * @var ResourceInterface
     */
    private $resource;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * CreateAsset constructor.
     * @param $resource
     * @param $user
     * @param $name
     * @param $description
     */
    public function __construct(ResourceInterface $resource, User $user, string $name, string $description)
    {
        $this->resource = $resource;
        $this->user = $user;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return Asset
     */
    public function handle() : Asset
    {
        $image = $this->dispatch(new CreateImageFromRaw($this->resource->getImage()->getRaw()));

        $asset = new Asset();
        $asset->setResource($this->resource);
        $asset->setUser($this->user);
        $asset->setImage($image);

        $asset->type = $this->resource->getType();
        $asset->name = $this->name;
        $asset->description = $this->description;

        \AssetRepo::add($asset);

        $this->dispatch(new SetPrimaryTags($asset));

        return $asset;
    }
}
