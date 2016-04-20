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

    /**
     * Adds the entity to this repository
     *
     * @param $entity
     * @return mixed
     */
    public function add($entity);

    /**
     * Updates the entity to this repository
     *
     * @param $entity
     * @return mixed
     */
    public function edit($entity);

    /**
     * Removes the entity from this repository
     * 
     * @param $entity
     * @return mixed
     */
    public function remove($entity);
}
