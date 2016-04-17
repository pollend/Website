<?php


namespace PN\Assets\Filter;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use PN\Resources\Resource;

class StatFilter implements FilterInterface
{
    private $stats;

    public function setFilterValue($value) : FilterInterface
    {
        $this->stats = $value;

        return $this;
    }

    public function appendQuery($model) : Builder
    {
        $query = \DB::table('resource_stats')->selectRaw('*, COUNT(resource_id) as matchings');

        $i = 0;
        foreach ($this->stats as $statId => $value) {
            $query = $query->orWhere(function($query2) use ($statId, $value, &$i) {
                $stat = \StatRepo::find($statId);

                if (in_array($stat->slug, ['rating-intensity', 'rating-nausea'])) {
                    if($value < 100) {
                        $query2->where('stat_id', $statId)->where('value', '<', (int)$value);
                        $i++;
                    }
                } elseif ($value > 0) {
                    $query2->where('stat_id', $statId)->where('value', '>', (int)$value);
                    $i++;
                }

            });
        }

        $resourceIds = Collection::make($query->groupBy('resource_id')->having('matchings', '>=', $i)->get('matchings'))->pluck('resource_id');

        if($i == 0) {
            return $model;
        }

        return $model->whereIn('resource_id', $resourceIds->toArray());
    }
}