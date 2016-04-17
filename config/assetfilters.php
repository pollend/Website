<?php

return [
    'blueprint' => [
        'base' => [
            'rating-excitement' => [
                'name' => 'Minimum Excitement',
                'ticks' => [
                    0, 20, 40, 60, 80
                ],
                'min' => 0,
                'max' => 80,
                'step' => 20,
                'default' => 0
            ],
            'rating-intensity' => [
                'name' => 'Maximum Intensity',
                'ticks' => [
                    20, 20, 40, 60, 80, 100
                ],
                'min' => 20,
                'max' => 100,
                'step' => 20,
                'default' => 100
            ],
            'rating-nausea' => [
                'name' => 'Maximum Nausea',
                'ticks' => [
                    20, 20, 40, 60, 80, 100
                ],
                'min' => 20,
                'max' => 100,
                'step' => 20,
                'default' => 100
            ]
        ],
        'advanced' => [
            'air-time' => [
                'name' => 'Air time',
                'ticks' => [
                    0, 20, 40, 60
                ],
                'min' => 0,
                'max' => 60,
                'step' => 20,
                'default' => 0
            ],
            'drops' => [
                'name' => 'Drops',
                'ticks' => [
                    0, 5, 10, 15, 20
                ],
                'min' => 0,
                'max' => 20,
                'step' => 5,
                'default' => 0
            ],
            'biggest-drop' => [
                'name' => 'Biggest Drop',
                'ticks' => [
                    0, 20, 40, 60, 80
                ],
                'min' => 0,
                'max' => 80,
                'step' => 20,
                'default' => 0
            ],
            'average-speed' => [
                'name' => 'Average speed',
                'ticks' => [
                    0, 10, 20, 30, 40
                ],
                'min' => 0,
                'max' => 40,
                'step' => 10,
                'default' => 0
            ],
            'max-speed' => [
                'name' => 'Max speed',
                'ticks' => [
                    0, 30, 60, 90, 120, 150
                ],
                'min' => 0,
                'max' => 150,
                'step' => 30,
                'default' => 0
            ],
            'ride-length-time' => [
                'name' => 'Ride Length Time',
                'ticks' => [
                    0, 30, 60, 90, 120, 150
                ],
                'min' => 0,
                'max' => 150,
                'step' => 30,
                'default' => 0
            ],
            'ride-length-distance' => [
                'name' => 'Ride Length Time',
                'ticks' => [
                    0, 250, 500, 750, 1000
                ],
                'min' => 0,
                'max' => 1000,
                'step' => 250,
                'default' => 0
            ],
            'inversions' => [
                'name' => 'Inversions',
                'ticks' => [
                    0, 2, 4, 6, 8
                ],
                'min' => 0,
                'max' => 8,
                'step' => 2,
                'default' => 0
            ],
            'head-choppers' => [
                'name' => 'Head Choppers',
                'ticks' => [
                    0, 5, 10, 15, 20
                ],
                'min' => 0,
                'max' => 20,
                'step' => 5,
                'default' => 0
            ],
        ]
    ],
    'park' => [
        'base' => [
            'size-x' => [
                'name' => 'Size X',
                'ticks' => [

                ],
                'min' => 0,
                'max' => 500,
                'step' => 50,
                'default' => 0
            ],
            'size-y' => [
                'name' => 'Size Y',
                'ticks' => [

                ],
                'min' => 0,
                'max' => 500,
                'step' => 50,
                'default' => 0
            ],
            'money' => [
                'name' => 'Money',
                'ticks' => [

                ],
                'min' => 0,
                'max' => 100000,
                'step' => 5000,
                'default' => 0
            ],
            'guest-count' => [
                'name' => 'Guests',
                'ticks' => [

                ],
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 0
            ],
            'park-year' => [
                'name' => 'Year',
                'ticks' => [

                ],
                'min' => 0,
                'max' => 20,
                'step' => 1,
                'default' => 0
            ],
            'rating-price-satisfaction' => [
                'name' => 'Price Rating',
                'ticks' => [
                    0, 20, 40, 60, 80
                ],
                'min' => 0,
                'max' => 80,
                'step' => 20,
                'default' => 0
            ],
            'rating-cleanliness' => [
                'name' => 'Cleanliness Rating',
                'ticks' => [
                    0, 20, 40, 60, 80
                ],
                'min' => 0,
                'max' => 80,
                'step' => 20,
                'default' => 0
            ],
            'rating-happiness' => [
                'name' => 'Happiness Rating',
                'ticks' => [
                    0, 20, 40, 60, 80
                ],
                'min' => 0,
                'max' => 80,
                'step' => 20,
                'default' => 0
            ],
        ],
        'advanced' => [

        ]
    ],
    'mod' => [
        'base' => [
        ],
        'advanced' => [

        ]
    ]
];