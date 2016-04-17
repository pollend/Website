<?php

namespace PN\Resources\Extractors;


use Illuminate\Support\Collection;

interface ExtractorInterface
{
    public function __construct($path);

    public function getData();

    public function getStats() : Collection;
}
