<?php


namespace PN\Resources;


interface ResourcePresenterInterface
{
    public function getStatGroups();

    public function isReleasable();

    public function getVersion();

    public function getZipBallUrl();
}