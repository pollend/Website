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
                'Ratings'       => [
                    'rating_excitement' => 'Rating Excitement',
                    'rating_intensity'  => 'Rating Intensity',
                    'rating_nausea'     => 'Rating Nausea',
                ],
                'Drops'         => [
                    'air_time'          => 'Air Time (sec)',
                    'drops'             => 'Drops',
                    'total_drop_height' => 'Total Drop Height (meter)',
                    'biggest_drop'      => 'Biggest Drop (meter)',
                ],
                'Speeds'        => [
                    'average_speed' => 'Average Speed (km/h)',
                    'max_speed'     => 'Max Speed (km/h)',
                ],
                'G-Force'       => [
                    'min_vert_g' => 'Minimum Vertical G',
                    'max_vert_g' => 'Maximum Vertical G',
                    'min_lat_g'  => 'Minimum Lat G',
                    'max_lat_g'  => 'Maximum Lat G',
                    'min_long_g' => 'Minimum Long G',
                    'max_long_g' => 'Maximum Long G',
                ],
                'Ride'          => [
                    'ride_length_time'     => 'Ride Time (seconds)',
                    'ride_length_distance' => 'Ride Distance (meter)',
                    'inversions'           => 'Inversions',
                    'head_choppers'        => 'Head Choppers',
                ],
                'Miscellaneous' => [
                    'entrance_fee'             => 'Entrance Fee',
                    'train_count'              => 'Train Count',
                    'train_length'             => 'Train Length',
                    'train_total'              => 'Total Cars',
                    'maximum_estimated_profit' => 'Max profit per hour (1$ entrance)',
                ],
            ],
            'park'      => [
                'Park info' => [
                    "size_x"                    => 'Size Width',
                    "size_y"                    => 'Size Height',
                    "money"                     => 'Money',
                    "park_entrance_fee"         => 'Entrance Fee',
                    "rating_price_satisfaction" => 'Rating Price Satisfaction',
                    "rating_cleanliness"        => 'Rating Cleanliness',
                    "rating_happiness"          => 'Rating Happiness',
                    "park_year"                 => 'Park year',
                    "guest_count"               => 'Guest Count',
                ],
            ],
            'mod'       => [

            ],
        ];

        foreach ($stats as $type => $categories) {
            foreach ($categories as $category => $stats) {
                foreach($stats as $name => $title){
                    $stat = \PN\Assets\Stats\Stat::where('type', $type)->where('name', $name)->first();

                    if($stat == null){
                        $stat = new \PN\Assets\Stats\Stat();
                    }

                    $stat->fill([
                        'type' => $type,
                        'name' => $name,
                        'title' => $title
                    ]);

                    $stat->save();
                }
            }
        }
    }
}
