<?php
namespace PN\Foundation\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;


/**
 * Class BaseRepository
 * @package PN\Foundation
 */
interface BaseRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $id
     * @return object
     */
    public function findByIdentifier(string $id);
}
