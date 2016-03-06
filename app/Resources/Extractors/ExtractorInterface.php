<?php

namespace PN\Resources\Extractors;


interface ExtractorInterface
{
    public function __construct($path);

    public function getData();
}
