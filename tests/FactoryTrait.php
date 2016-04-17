<?php

namespace Tests;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Assets\Asset;
use PN\Resources\Stats\ResourceStat;
use PN\Resources\Stats\Stat;
use PN\Media\Jobs\CreateImageFromRaw;
use PN\Resources\Album;
use PN\Resources\Resource;
use PN\Media\Image;
use PN\Resources\Jobs\CreateResource;
use PN\Resources\Park;
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
        $user = $this->createUser($attributes);

        \Auth::login($user);

        $this->user = $user;

        return $this->user;
    }

    public function createUser($attributes = [])
    {
        $user = factory(User::class)->create(array_merge($attributes, ['password' => \Hash::make(array_get($attributes, 'password', '123456'))]));

        return $user;
    }

    public $blueprint = 'blueprint';
    public $park = 'park';
    public $mod = 'mod';

    public function createBlueprint($quick = true)
    {
        $asset = $this->createBaseAsset($quick);

        /**
         * Bind asset resource
         */
        $blueprintResource = $this->createResourceBlueprint($quick);

        $asset->resource_id = $blueprintResource->id;

        $asset->type = 'blueprint';

        $asset->save();

        for($i = 0; $i < 3; $i++) {
            $image = $this->createResourceImage($quick);

            $asset->addImage($image);
        }

        $this->createStats($asset);

        return $asset;
    }

    public function createPark($quick = true)
    {
        $asset = $this->createBaseAsset($quick);

        /**
         * Bind asset resource
         */
        $parkResource = $this->createResourcePark($quick);

        $asset->resource_id = $parkResource->id;

        $asset->type = 'park';

        $asset->save();

        for($i = 0; $i < 3; $i++) {
            $image = $this->createResourceImage($quick);

            $asset->addImage($image);
        }

        $this->createStats($asset);

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

    public function createStats($asset)
    {
        $stats = Stat::where('type', $asset->type)->get();

        foreach($stats as $stat) {
            ResourceStat::create([
                'asset_id' => $asset->id,
                'stat_id' => $stat->id,
                'value' => rand(0, 100)
            ]);
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

        $asset->setImage($image);

        return $asset;
    }

    public function createResourceImage($quick = true)
    {
        if($quick) {
            return factory(Image::class)->create();
        }

        $image = $this->dispatch(new CreateImageFromRaw(file_get_contents(base_path('tests/files/image.jpg'))));

        $image->save();

        return $image;
    }

    /**
     * @param $quick
     * @return mixed
     */
    public function createResourceBlueprint($quick)
    {
        if (!$quick) {
            $blueprintResource = $this->dispatch(app(CreateResource::class, [base_path('tests/files/blueprint.png')]));
        } else {
            $blueprintResource = factory(Resource::class)->create([
                'type' => 'blueprint'
            ]);
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
            $parkResource = $this->dispatch(app(CreateResource::class, [base_path('tests/files/save.txt')]));
        } else {
            $parkResource = factory(Resource::class)->create([
                'type' => 'park'
            ]);
        }

        return $parkResource;
    }
}
