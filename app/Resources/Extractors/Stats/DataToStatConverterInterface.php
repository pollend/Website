<?php


namespace PN\Resources\Extractors\Stats;


use Illuminate\Support\Collection;

interface DataToStatConverterInterface
{
    public function convert(array $data) : Collection;
}