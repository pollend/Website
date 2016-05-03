<?php


namespace PN\Assets;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PN\Assets\Filter\FilterInterface;
use PN\Assets\Filter\MaxAgeFilter;
use PN\Assets\Filter\NameLikeFilter;
use PN\Assets\Filter\SortByFilter;
use PN\Assets\Filter\StatFilter;
use PN\Assets\Filter\TypeFilter;
use PN\Assets\Filter\WithoutTagFilter;
use PN\Assets\Filter\WithTagFilter;

class AssetFilter
{
    private $type;

    private $withTags;

    private $withoutTags;

    private $stats;

    private $name;

    private $sort;

    private $maxAge;

    public function withType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function withTags($tags)
    {
        $this->withTags = $tags;

        return $this;
    }

    public function withoutTags($tags)
    {
        $this->withoutTags = $tags;

        return $this;
    }

    public function withStats($stats)
    {
        $this->stats = $stats;

        return $this;
    }

    public function withNameLike($name)
    {
        $this->name = $name;

        return $this;
    }

    public function sortBy($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    public function withMaxAge($date)
    {
        $this->maxAge = $date;

        return $this;
    }

    private function buildQuery() : Builder
    {
        $asset = new Asset();

        $asset = $asset->where('buildoff_id', null);

        $asset = $this->appendQuery($asset, new TypeFilter(), $this->type);
        $asset = $this->appendQuery($asset, new NameLikeFilter(), $this->name);
        $asset = $this->appendQuery($asset, new WithTagFilter(), $this->withTags);
        $asset = $this->appendQuery($asset, new WithoutTagFilter(), $this->withoutTags);
        $asset = $this->appendQuery($asset, new MaxAgeFilter(), $this->maxAge);
        $asset = $this->appendQuery($asset, new SortByFilter(), $this->sort);
        $asset = $this->appendQuery($asset, new StatFilter(), $this->stats);

        return $asset;
    }

    private function appendQuery($asset, FilterInterface $filter, $value) : Builder
    {
        if ($value != null) {
            $asset = $filter->setFilterValue($value)
                ->appendQuery($asset);
        }

        return $asset;
    }

    public function filter() : Collection
    {
        return $this->buildQuery()->get();
    }

    public function filterPaginated() : Paginator
    {
        return $this->buildQuery()->paginate(12);
    }
}