<?php


namespace PN\Social\Repositories;


use PN\Assets\Asset;
use PN\Foundation\Repositories\BaseRepositoryInterface;

interface CommentRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Gets all comments sorted descending for given asset
     *
     * @param Asset $asset
     * @return mixed
     */
    public function forAsset(Asset $asset);
}