<?php


namespace PN\Resources\Repositories;


use PN\Foundation\Repositories\BaseRepositoryInterface;

interface ResourceRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Finds the last created resource mod by username and repo
     *
     * @param $username
     * @param $repo
     * @return mixed
     */
    public function findMod($username, $repo);
}