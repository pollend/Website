<?php


namespace PN\Resources\Extractors;


use Illuminate\Support\Collection;

class ModExtractor implements ExtractorInterface
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getData()
    {
        return [];
    }

    public function getStats() : Collection
    {
        return new Collection();
    }

    public function getName() : string
    {
        return (new Collection(explode('/', $this->path)))->last();
    }
}