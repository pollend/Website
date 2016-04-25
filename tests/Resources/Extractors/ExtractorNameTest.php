<?php


namespace Tests\Resources\Extractors;


class ExtractorNameTest extends \TestCase
{
    public function test_blueprint_name()
    {
        $resource = \ResourceUtil::make(base_path('tests/files/blueprint.png'));

        $this->assertEquals('Trojan', $resource->getExtractor()->getName());
    }

    public function test_park_name()
    {
        $resource = \ResourceUtil::make(base_path('tests/files/park.txt'));

        $this->assertEquals('Better Starting Park', $resource->getExtractor()->getName());
    }

    public function test_mod_name()
    {
        $resource = \ResourceUtil::make("https://github.com/ParkitectNexus/CoasterCam");

        $this->assertEquals('CoasterCam', $resource->getExtractor()->getName());
    }
}