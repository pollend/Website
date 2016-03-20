<?php

namespace PN\Assets\Repositories;


use PN\Foundation\Repositories\BaseRepositoryInterface;

interface AssetRepositoryInterface extends BaseRepositoryInterface
{
    function mostPopular($count);
}
