<?php

class DownloadSeeder extends BaseSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assetCount = \PN\Assets\Asset::count();
        $downloads = $assetCount * 50;

        for ($i = 0; $i < $downloads; $i++) {
            $asset = $this->getRandom(\PN\Assets\Asset::class);
            $userId = $this->getRandom(\PN\Users\User::class)->id;

            if (rand(1, 5) < 5) {
                $userId = null;
            }

            factory(\PN\Tracking\Download::class)->create([
                'user_id'           => $userId,
                'downloadable_id'   => $asset->id,
                'downloadable_type' => get_class($asset),
            ]);
        }
    }
}
