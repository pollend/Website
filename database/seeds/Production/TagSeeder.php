<?php

class TagSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'type'           => 'blueprint',
                'tag'            => 'Transport',
                'slug'           => 'transport',
                'parkitect_type' => 'Transport',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Rollercoaster',
                'slug'           => 'rollercoaster',
                'parkitect_type' => 'Rollercoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Log Flume',
                'slug'           => 'log-flume',
                'parkitect_type' => 'LogFlume',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Mini Coaster',
                'slug'           => 'mini-coaster',
                'parkitect_type' => 'MiniCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Miniature Railway',
                'slug'           => 'miniature-railway',
                'parkitect_type' => 'MiniatureRailway',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Steel Coaster',
                'slug'           => 'steel-coaster',
                'parkitect_type' => 'SteelCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Suspended Coaster',
                'slug'           => 'suspended-coaster',
                'parkitect_type' => 'SuspendedCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Suspended Monorail',
                'slug'           => 'suspended-monorail',
                'parkitect_type' => 'SuspendedMonorail',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Wild Mouse',
                'slug'           => 'wild-mouse',
                'parkitect_type' => 'WildMouse',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Wing Coaster',
                'slug'           => 'wing-coaster',
                'parkitect_type' => 'WingCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Wooden Coaster',
                'slug'           => 'wooden-coaster',
                'parkitect_type' => 'WoodenCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Gentle Coaster',
                'slug'           => 'gentle-coaster',
                'parkitect_type' => 'GentleCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Intense Coaster',
                'slug'           => 'intense-coaster',
                'parkitect_type' => 'IntenseCoaster',
                'primary'        => 0,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Compact Coaster',
                'slug'           => 'compact-coaster',
                'parkitect_type' => 'CompactCoaster',
                'primary'        => 0,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Large Coaster',
                'slug'           => 'large-coaster',
                'parkitect_type' => 'LargeCoaster',
                'primary'        => 0,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Replica Coaster',
                'slug'           => 'replica-coaster',
                'parkitect_type' => 'ReplicaCoaster',
                'primary'        => 0,
            ],
            [
                'type'           => 'park',
                'tag'            => 'Small Park',
                'slug'           => 'small-park',
                'parkitect_type' => 'SmallPark',
                'primary'        => 0,
            ],
            [
                'type'           => 'park',
                'tag'            => 'Large Park',
                'slug'           => 'large-park',
                'parkitect_type' => 'LargePark',
                'primary'        => 0,
            ],
            [
                'type'           => 'park',
                'tag'            => 'Scenario',
                'slug'           => 'scenario',
                'parkitect_type' => 'Scenario',
                'primary'        => 0,
            ],
            [
                'type'           => 'park',
                'tag'            => 'Filled Park',
                'slug'           => 'filled-park',
                'parkitect_type' => 'FilledPark',
                'primary'        => 0,
            ],
            [
                'type'           => 'park',
                'tag'            => 'Replica Park',
                'slug'           => 'replica-park',
                'parkitect_type' => 'ReplicaPark',
                'primary'        => 0,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Water',
                'slug'           => 'water',
                'parkitect_type' => 'Water',
                'primary'        => 1,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'Camera',
                'slug'           => 'camera',
                'parkitect_type' => 'Camera',
                'primary'        => 0,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'Shop',
                'slug'           => 'shop',
                'parkitect_type' => 'Shop',
                'primary'        => 0,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'Scenery',
                'slug'           => 'scenery',
                'parkitect_type' => 'Scenery',
                'primary'        => 0,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'Attraction',
                'slug'           => 'attraction',
                'parkitect_type' => 'Attraction',
                'primary'        => 0,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'Rollercoaster',
                'slug'           => 'rollercoaster',
                'parkitect_type' => 'RollercoasterMod',
                'primary'        => 0,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'Coaster Train',
                'slug'           => 'coastertrain',
                'parkitect_type' => 'CoasterTrain',
                'primary'        => 0,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'UI',
                'slug'           => 'ui',
                'parkitect_type' => 'UI',
                'primary'        => 0,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'Cheats',
                'slug'           => 'cheats',
                'parkitect_type' => 'Cheats',
                'primary'        => 0,
            ],
            [
                'type'           => 'mod',
                'tag'            => 'Gameplay',
                'slug'           => 'gameplay',
                'parkitect_type' => 'Gameplay',
                'primary'        => 0,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Modded',
                'slug'           => 'modded',
                'parkitect_type' => 'Modded',
                'primary'        => 0,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Vertical Dropcoaster',
                'slug'           => 'vertical-dropcoaster',
                'parkitect_type' => 'VerticalDropCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Alpine Coaster',
                'slug'           => 'alpine-coaster',
                'parkitect_type' => 'AlpineCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Bobsled Coaster',
                'slug'           => 'bobsled-coaster',
                'parkitect_type' => 'BobsledCoaster',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Has Scenery',
                'slug'           => 'has-scenery',
                'parkitect_type' => 'HasScenery',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Has Only Scenery',
                'slug'           => 'has-only-scenery',
                'parkitect_type' => 'HasOnlyScenery',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Has Flat Rides',
                'slug'           => 'has-flat-rides',
                'parkitect_type' => 'HasFlatRides',
                'primary'        => 1,
            ],
            [
                'type'           => 'blueprint',
                'tag'            => 'Has Coaster',
                'slug'           => 'has-coaster',
                'parkitect_type' => 'HasCoaster',
                'primary'        => 1,
            ],
        ];

        foreach ($tags as $tag) {
            factory(\PN\Assets\Tag::class)->create($tag);
        }
    }
}
