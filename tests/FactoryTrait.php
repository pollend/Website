<?php

namespace Tests;


use Illuminate\Foundation\Bus\DispatchesJobs;
use ParkitectNexus\Jobs\Resources\Blueprints\CreateResourceBlueprint;
use ParkitectNexus\Jobs\Resources\Images\CreateResourceImage;
use ParkitectNexus\Jobs\Resources\Parks\CreateResourcePark;
use ParkitectNexus\Models\Album;
use ParkitectNexus\Models\Asset;
use ParkitectNexus\Models\Resource\Blueprint as ResourceBlueprint;
use ParkitectNexus\Models\Resource\Image;
use ParkitectNexus\Models\Resource\Park as ResourcePark;
use ParkitectNexus\Models\Screenshot;
use ParkitectNexus\Models\Stat\Blueprint;
use ParkitectNexus\Models\Stat\Park;
use PN\Users\User;

trait FactoryTrait
{
    use DispatchesJobs;

    /**
     * @var User
     */
    public $user;

    /**
     * @param array $attributes
     * @return User
     */
    public function login($attributes = [])
    {
        $user = factory(User::class)->create($attributes);

        \Auth::login($user);

        $this->user = $user;

        return $this->user;
    }

    public $blueprint = 'blueprint';
    public $park = 'park';
    public $mod = 'mod';

    public function createBlueprint($quick = true)
    {
        $asset = $this->createBaseAsset($quick);

        /**
         * Bind stats
         */
        $blueprintStat = factory(Blueprint::class)->create();

        $asset->stats_id = $blueprintStat->id;
        $asset->stats_type = get_class($blueprintStat);

        /**
         * Bind asset resource
         */
        $blueprintResource = $this->createResourceBlueprint($quick);

        $asset->resource_id = $blueprintResource->id;
        $asset->resource_type = get_class($blueprintResource);

        $asset->type = 'blueprint';

        $asset->save();

        return $asset;
    }

    public function createPark($quick = true)
    {
        $asset = $this->createBaseAsset($quick);

        /**
         * Bind stats
         */
        $parkStat = factory(Park::class)->create();

        $asset->stats_id = $parkStat->id;
        $asset->stats_type = get_class($parkStat);

        /**
         * Bind asset resource
         */
        $parkResource = $this->createResourcePark($quick);

        $asset->resource_id = $parkResource->id;
        $asset->resource_type = get_class($parkResource);

        $asset->type = 'park';

        $asset->save();

        return $asset;
    }

    public function createAsset($quick = true)
    {
        switch(rand(0, 1)){
            case 0:
                return $this->createBlueprint($quick);
            case 1:
                return $this->createPark($quick);
        }
    }

    private function createBaseAsset($quick = true)
    {
        $asset = factory(Asset::class)->make([
            'user_id' => $this->login()->id
        ]);

        /**
         * Bind thumbnail
         */
        $image = $this->createResourceImage($quick);

        $asset->resource_image_id = $image->id;

        /**
         * Bind album
         */
        $album = factory(Album::class)->create();
        for($i = 0; $i < 3; $i++) {
            $image = $this->createResourceImage($quick);

            Album\Image::create([
                'album_id' => $album->id,
                'resource_image_id' => $image->id
            ]);
        }

        $asset->album_id = $album->id;

        return $asset;
    }

    public function createResourceImage($quick = true)
    {
        if(!$quick) {
            return $this->dispatch(app(CreateResourceImage::class, [app_path('../tests/files/image.jpg')]));
        }

        return factory(Image::class)->create();
    }

    /**
     * @param $quick
     * @return mixed
     */
    public function createResourceBlueprint($quick)
    {
        if (!$quick) {
            $blueprintResource = $this->dispatch(app(CreateResourceBlueprint::class,
                [app_path('../tests/files/blueprint.png')]));
        } else {
            $blueprintResource = factory(ResourceBlueprint::class)->create();
        }

        return $blueprintResource;
    }

    public function createScreenshot($quick = true)
    {
        return factory(Screenshot::class)->create([
            'user_id' => $this->login()->id,
            'resource_image_id' => $this->createResourceImage($quick)->id
        ]);
    }

    /**
     * @param $quick
     * @return mixed
     */
    public function createResourcePark($quick)
    {
        if (!$quick) {
            $parkResource = $this->dispatch(app(CreateResourcePark::class, [app_path('../tests/files/save.txt')]));
        } else {
            $parkResource = factory(ResourcePark::class)->create();
        }

        return $parkResource;
    }
}
