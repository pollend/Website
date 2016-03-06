<?php

namespace PN\Resources\Validators;


use PN\Resources\Extractors\BlueprintExtractor;

/**
 * Class BlueprintValidator
 * @package PN\PN\Resource\File\Validator
 */
class BlueprintValidator implements ValidatorInterface
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
        $extrator = new BlueprintExtractor($this->path);

        return $extrator->getData() != null;
    }
}
