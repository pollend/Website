<?php

namespace PN\Assets\Repositories\Criteria;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class TimespanCriteria implements CriteriaInterface
{
    private $afterTimespan;

    /**
     * TimespanCriteria constructor.
     * @param $afterTimespan
     */
    public function __construct($afterTimespan)
    {
        $this->afterTimespan = $afterTimespan;
    }

    /**
     * Apply criteria in query repository
     *
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($this->afterTimespan)));
    }
}
