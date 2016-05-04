<?php


namespace PN\Assets\Jobs;


use PN\Assets\Asset;
use PN\Jobs\Job;
use PN\Resources\ResourceInterface;
use PN\Users\User;

class UpdateAsset extends Job
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    public function __construct(Asset $asset, string $name, string $description)
    {
        $this->asset = $asset;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return Asset
     */
    public function handle() : Asset
    {
        $this->asset->name = $this->name;
        $this->asset->description = $this->description;

        \AssetRepo::edit($this->asset);

        return $this->asset;
    }
}