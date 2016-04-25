<?php

namespace PN\Assets\Repositories;


use PN\BuildOffs\BuildOff;
use PN\Foundation\Repositories\BaseRepositoryInterface;

interface AssetRepositoryInterface extends BaseRepositoryInterface
{
    function mostPopular($count);

    /**
     * Gets assets that participated in a build-off
     *
     * @param BuildOff $buildOff
     * @return mixed
     */
    public function forBuildOff(BuildOff $buildOff);
}
