<?php

use PN\Assets\Jobs\SetPrimaryTags;

class AssetSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mods = 50;
        $parks = 100;
        $blueprints = 200;

        for ($i = 0; $i < $mods; $i++) {
            $resource = ResourceUtil::make('https://github.com/ParkitectNexus/CoasterCam');

            $resource->save();

            $this->createAsset($resource);

            echo "Mod $i/$mods created\n";
        }

        for ($i = 0; $i < $parks; $i++) {
            $resource = ResourceUtil::make($this->getRandomFile(base_path('database/seeds/files/parks')));

            $resource->save();

            $this->createAsset($resource);

            echo "Park $i/$parks created\n";
        }

        for ($i = 0; $i < $blueprints; $i++) {
            $resource = ResourceUtil::make($this->getRandomFile(base_path('database/seeds/files/blueprints')));

            $resource->save();

            $this->createAsset($resource);

            echo "Blueprint $i/$blueprints created\n";
        }
    }

    private function createAsset($resource)
    {
        $asset = factory(\PN\Assets\Asset::class)->create([
            'type' => $resource->getType(),
            'user_id' => $this->getRandom(\PN\Users\User::class)->id,
            'image_id' => $this->createImage()->id,
            'resource_id' => $resource->id
        ]);

        $images = rand(0, 8);

        for ($i = 0; $i < $images; $i++) {
            $asset->addImage($this->createImage());
        }

        $tags = $this->getRandom(\PN\Assets\Tag::class, ['primary' => 0, 'type' => $resource->getType()], rand(2, 5));

        foreach ($tags as $tag) {
            $asset->addTag($tag);
        }

        $this->dispatch(app(SetPrimaryTags::class, [$asset]));

        $this->dispatch(new \PN\Resources\Stats\Jobs\CreateStats($resource));
    }
}
