<?php

class CommentSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assetCount = \PN\Assets\Asset::count();
        $comments = $assetCount * 5;

        for ($i = 0; $i < $comments; $i++) {
            $asset = $this->getRandom(\PN\Assets\Asset::class);
            $user = $this->getRandom(\PN\Users\User::class);

            factory(\PN\Social\Comment::class)->create([
                'user_id'  => $user->id,
                'asset_id' => $asset->id,
            ]);
        }
    }
}
