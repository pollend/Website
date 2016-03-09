<?php

class LikeSeeder extends BaseSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assetCount = \PN\Assets\Asset::count();
        $likes = $assetCount * 25;

        for ($i = 0; $i < $likes; $i++) {
            $asset = $this->getRandom(\PN\Assets\Asset::class);
            $user = $this->getRandom(\PN\Users\User::class);

            factory(\PN\Social\Like::class)->create([
                'user_id'       => $user->id,
                'likeable_id'   => $asset->id,
                'likeable_type' => get_class($asset),
            ]);
        }
    }
}
