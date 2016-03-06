<?php

namespace PN\Resources\Validators;

/**
 * Interface ValidatorInterface
 * @package PN\PN\Resource\File\Validator
 */
interface ValidatorInterface
{
    /**
     * @param $path
     */
    public function __construct($path);

    /**
     * @return bool
     */
    public function isValid();
}
