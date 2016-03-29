<?php
namespace PN\Assets\Repositories;

use PN\Foundation\Repositories\BaseRepositoryInterface;

interface TagRepositoryInterface extends BaseRepositoryInterface
{
    public function findPrimary($type);

    public function findSecondary($type);

    public function findByPrimaryTags($tagTypes);

    public function findByTagName($name);
}
