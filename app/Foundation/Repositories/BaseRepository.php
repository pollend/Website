<?php

namespace PN\Foundation\Repositories;


/**
 * Class BaseRepository
 * @package PN\Foundation
 */
abstract class BaseRepository extends \Prettus\Repository\Eloquent\BaseRepository implements BaseRepositoryInterface
{
    /**
     * Finds a record by identifier, fall
     *
     * @param $id
     * @return object
     */
    public function findByIdentifier($id)
    {
        try {
            $record = $this->findByField('identifier', $id)->first();

            if($record == null) {
                throw new \Exception("I'm just a harmless hack to fallback to the catch block");
            }
        } catch (\Exception $e) {
            $record = $this->find($id);

            if($record->identifier != $id) {
                $record = null;
            }
        }

        return $record;
    }
}
