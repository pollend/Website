<?php

use PN\Assets\Asset;

class AssetDependenciesSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dependencies = Asset::where('type', 'mod')->count() / 0.75;

        for ($i = 0; $i < $dependencies; $i++) {
            $asset = $this->getRandom(\PN\Assets\Asset::class, ['type' => 'mod']);
            $dependency = $this->getRandom(\PN\Assets\Asset::class);

            \PN\Assets\Dependency::create([
                'asset_id'      => $asset->id,
                'dependency_id' => $dependency->id,
            ]);
        }
    }
}
