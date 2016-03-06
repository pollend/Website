<?php

namespace PN\Foundation\Repositories;


/**
 * Class BaseRepository
 * @package PN\Foundation
 */
abstract class BaseRepository extends \Prettus\Repository\Eloquent\BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param int $id
     * @return object
     */
    public function findByIdentifier(string $id)
    {
        return $this->findByField('identifier', $id)->first();
    }
}
