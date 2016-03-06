<?php

namespace PN\Resources\Validators;

use PN\Resources\Extractors\ParkExtractor;

/**
 * Class ParkValidator
 * @package PN\PN\Resource\File\Validator
 */
class ParkValidator implements ValidatorInterface
{
    /**
     * @var
     */
    private $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $extrator = new ParkExtractor($this->path);

        return $extrator->getData() != null;
    }
}
