<?php


namespace PN\Resources\Extractors;


class ModExtractor implements ExtractorInterface
{
    public function __construct($path)
    {
        parent::__construct($path);
    }

    public function getData()
    {
        return [];
    }
}