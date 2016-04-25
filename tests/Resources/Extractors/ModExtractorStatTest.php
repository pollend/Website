<?php


namespace Tests\Resources\Extractors;


use PN\Resources\Extractors\ModExtractor;

class ModExtractorStatTest extends \TestCase
{
    public function test_mod_stats() {

        $parkExtractor = new ModExtractor("https://github.com/ParkitectNexus/CoasterCam");

        $this->assertEmpty($parkExtractor->getStats()->toArray());
    }
}