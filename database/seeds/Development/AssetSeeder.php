<?php

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
            $resource = factory(\PN\Resources\Mod::class)->create([
                'image_id' => $this->createImage()->id,
            ]);

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
        $album = factory(\PN\Resources\Album::class)->create();

        $asset = factory(\PN\Assets\Asset::class)->create([
            'type'          => $resource->getType(),
            'user_id'       => $this->getRandom(\PN\Users\User::class)->id,
            'album_id'      => $album->id,
            'image_id'      => $this->createImage()->id,
            'resource_id'   => $resource->id,
            'resource_type' => get_class($resource),
        ]);

        $images = rand(0, 8);

        for($i = 0; $i < $images; $i++) {
            \PN\Resources\AlbumImage::create([
                'album_id' => $album->id,
                'image_id' => $this->createImage()->id
            ]);
        }

        $tags = $this->getRandom(\PN\Assets\Tag::class, ['primary' => 0, 'type' => $resource->getType()], rand(2, 5));

        foreach ($tags as $tag) {
            \PN\Assets\AssetTag::create(['asset_id' => $asset->id, 'tag_id' => $tag->id]);
        }
    }
}
