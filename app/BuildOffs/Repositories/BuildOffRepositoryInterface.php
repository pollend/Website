<?php
namespace PN\BuildOffs\Repositories;

use Illuminate\Database\Eloquent\Collection;
use PN\BuildOffs\BuildOff;
use PN\Foundation\Repositories\BaseRepositoryInterface;

interface BuildOffRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Gets all buildoff in descending order
     * 
     * @return mixed
     */
    public function descended();

    /**
     * Gets all buildoffs that need to be closed
     *
     * @return Collection
     */
    public function overdue();

    /**
     * Gets assets participating this this buildoff sorted by likes
     *
     * @param BuildOff $buildOff
     * @return mixed
     */
    public function getAssetsSorted(BuildOff $buildOff);
}
