<?php


namespace Tests\Resources\Extractors;


use Illuminate\Support\Collection;
use PN\Resources\Extractors\ParkExtractor;

class ParkExtractorStatTest extends \TestCase
{
    public function test_park_stats()
    {
        $parkExtractor = new ParkExtractor(base_path('tests/files/park.txt'));

        $expectedStats = new Collection([
            "SizeX" => 100,
            "SizeY" => 100,
            "Money" => -438321.25,
            "ParkEntranceFee" => 0.0,
            "RatingPriceSatisfaction" => 79,
            "RatingCleanliness" => 34,
            "RatingHappiness" => 50,
            "ParkYear" => 71.0,
            "GuestCount" => 0
        ]);

        $this->assertEquals($expectedStats, $parkExtractor->getStats());
    }
}