<?php

class StatSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stats = [
            'blueprint' => [
                'Ratings' => [
                    'RatingExcitement' => 'Rating Excitement',
                    'RatingIntensity' => 'Rating Intensity',
                    'RatingNausea' => 'Rating Nausea',
                ],
                'Drops' => [
                    'AirTime' => 'Air Time (sec)',
                    'Drops' => 'Drops',
                    'TotalDropHeight' => 'Total Drop Height (meter)',
                    'BiggestDrop' => 'Biggest Drop (meter)',
                ],
                'Speeds' => [
                    'AverageSpeed' => 'Average Speed (km/h)',
                    'MaxSpeed' => 'Max Speed (km/h)',
                ],
                'G-Force' => [
                    'MinVertG' => 'Minimum Vertical G',
                    'MaxVertG' => 'Maximum Vertical G',
                    'MinLatG' => 'Minimum Lat G',
                    'MaxLatG' => 'Maximum Lat G',
                    'MinLongG' => 'Minimum Long G',
                    'MaxLongG' => 'Maximum Long G',
                ],
                'Ride' => [
                    'RideLengthTime' => 'Ride Time (seconds)',
                    'RideLengthDistance' => 'Ride Distance (meter)',
                    'Inversions' => 'Inversions',
                    'HeadChoppers' => 'Head Choppers',
                ],
                'Miscellaneous' => [
                    'EntranceFee' => 'Entrance Fee',
                    'TrainCount' => 'Train Count',
                    'TrainLength' => 'Train Length',
                    'TrainTotal' => 'Total Cars',
                    'MaximumEstimatedProfit' => 'Max profit per hour (1$ entrance)',
                ],
            ],
            'park' => [
                'Park info' => [
                    "SizeX" => 'Size Width',
                    "SizeY" => 'Size Height',
                    "Money" => 'Money',
                    "ParkEntranceFee" => 'Entrance Fee',
                    "RatingPriceSatisfaction" => 'Rating Price Satisfaction',
                    "RatingCleanliness" => 'Rating Cleanliness',
                    "RatingHappiness" => 'Rating Happiness',
                    "ParkYear" => 'Park year',
                    "GuestCount" => 'Guest Count',
                ],
            ],
            'mod' => [

            ],
        ];

        foreach ($stats as $type => $categories) {
            foreach ($categories as $category => $stats) {
                foreach ($stats as $name => $title) {
                    $stat = \PN\Resources\Stats\Stat::where('type', $type)->where('name', $name)->first();

                    if ($stat == null) {
                        $stat = new \PN\Resources\Stats\Stat();
                    }

                    $stat->fill([
                        'type' => $type,
                        'slug' => \Illuminate\Support\Str::snake($name, '-'),
                        'name' => $name,
                        'title' => $title
                    ]);

                    $stat->save();
                }
            }
        }
    }
}
