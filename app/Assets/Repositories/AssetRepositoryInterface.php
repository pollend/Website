<?php

namespace PN\Assets\Repositories;


use PN\BuildOffs\BuildOff;
use PN\Foundation\Repositories\BaseRepositoryInterface;
use PN\Users\User;

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

    /**
     * Gets assets uploaded by given users, can paginate
     *
     * @param User $user
     * @param bool $paginated
     * @param int $perPage
     * @return mixed
     */
    public function forUser(User $user, $paginated = false, $perPage = 12);

    /**
     * Counts the total assets of given type
     *
     * @param $type
     * @return mixed
     */
    public function countByType($type);

    /**
     * Finds assets by type
     *
     * @param $type
     * @return mixed
     */
    public function findByType($type);
}
