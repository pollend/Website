<?php
namespace PN\Assets\Repositories;

use PN\Assets\Asset;
use PN\Foundation\Repositories\BaseRepositoryInterface;

interface TagRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find tags for given asset
     * 
     * @param Asset $asset
     * @return mixed
     */
    public function forAsset(Asset $asset);

    public function findPrimary($type);

    public function findSecondary($type);

    public function findByPrimaryTags($tagTypes);

    public function findByTagName($name);
}
