<?php


namespace PN\Resources\Extractors;


use Illuminate\Support\Collection;

class ModExtractor implements ExtractorInterface
{
    public function __construct($path)
    {
        
    }

    public function getData()
    {
        return [];
    }

    public function getStats() : Collection
    {
        return new Collection();
    }
}