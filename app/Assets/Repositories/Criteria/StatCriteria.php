<?php

namespace PN\Assets\Repositories\Criteria;


use PN\Assets\Stats\Stat;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class StatCriteria implements CriteriaInterface
{
    private $stats;

    /**
     * StatCriteria constructor.
     * @param $stats
     */
    public function __construct($stats)
    {
        $this->stats = $stats;
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
        foreach($this->stats as $statId => $value) {
            $model = $model->whereIn('id', function ($query) use ($statId, $value) {
                $query = $query->select('asset_id')
                    ->from('asset_stats')
                    ->where('stat_id', $statId);

                    if (in_array($statId, [2, 3])) {
                        $query = $query->where('value', '<', (int)$value);
                    } else {
                        if ($value > 0) {
                            $query = $query->where('value', '>', (int)$value);
                        }
                    }
            });
        }

        return $model;
    }
}
