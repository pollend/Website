<?php


namespace PN\Resources\Extractors\Stats;


use Illuminate\Support\Collection;

class ParkStatConverter implements DataToStatConverterInterface
{
    public function convert(array $data) : Collection
    {
        $totalCamelCasedData = [
            'SizeX' => $data['Park']['XSize'],
            'SizeY' => $data['Park']['ZSize'], // y = z because ingame y is height, but on the website y is horizontal
            'Money' => $data['Park']['ParkInfo']['Money'],
            'ParkEntranceFee' => $data['Park']['ParkInfo']['ParkEntranceFee'],
            'RatingPriceSatisfaction' => (int)round($data['Park']['ParkInfo']['RatingPriceSatisfaction'] * 100),
            'RatingCleanliness' => (int)round($data['Park']['ParkInfo']['RatingCleanliness'] * 100),
            'RatingHappiness' => (int)round($data['Park']['ParkInfo']['RatingHappiness'] * 100),
            'ParkYear' => floor($data['Header']['ParkDate'] / 10 / 30 / 12),
            'GuestCount' => $data['GuestCount']
        ];
        
        return new Collection($totalCamelCasedData);
    }
}