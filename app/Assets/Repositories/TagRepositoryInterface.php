<?php
namespace PN\Assets\Repositories;

use PN\Foundation\Repositories\BaseRepositoryInterface;

interface TagRepositoryInterface extends BaseRepositoryInterface
{
    public function findPrimary();

    public function findSecondary();
}
