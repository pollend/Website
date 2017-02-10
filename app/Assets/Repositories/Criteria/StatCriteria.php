<?php

namespace PN\Assets\Repositories\Criteria;


use PN\Resources\Resource;
use PN\Resources\Stats\Stat;
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
        $resource = new Resource();

        foreach($this->stats as $statId => $value) {
            $resource = $resource->whereIn('id', function ($query) use ($statId, $value) {
                $query = $query->select('resource_id')
                    ->from('resource_stats')
                    ->where('stat_id', $statId);

                    if (in_array($statId, [2, 3])) {
                        $query->where('value', '<', (int)$value);
                    } else {
                        if ($value > 0) {
                            $query->where('value', '>', (int)$value);
                        }
                    }
            });
        }

        $resource = $resource->get();

        return $model->whereIn('resource_id', $resource->pluck('id'));
    }
}
