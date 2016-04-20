<?php
namespace PN\BuildOffs\Repositories;

use PN\Foundation\Repositories\BaseRepositoryInterface;

interface BuildOffRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Gets all buildoff in descending order
     * 
     * @return mixed
     */
    public function descended();
}
