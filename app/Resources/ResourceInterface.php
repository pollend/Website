<?php


namespace PN\Resources;


interface ResourceInterface
{
    public function overwriteImageWithDefault();

    public function getType();

    public function getPrimaryTags();
}
