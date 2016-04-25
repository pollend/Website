<?php


namespace Tests\Assets\Jobs;


use PN\Assets\Jobs\ParticipateInBuildOff;
use PN\BuildOffs\BuildOff;
use PN\BuildOffs\Exceptions\AssetMayNotParticipateInBuildOff;
use Tests\FactoryTrait;

class ParticipateInBuildOffTest extends \TestCase
{
    use FactoryTrait;

    public function test_participation()
    {
        $asset = $this->createBlueprint(false);

        $buildOff = factory(BuildOff::class)->create([
            'type_requirement' => 'blueprint'
        ]);

        $this->dispatch(new ParticipateInBuildOff($asset, $buildOff));

        $newAsset = \AssetRepo::find($asset->id);

        $this->assertEquals($newAsset->getBuildOff()->id, $buildOff->id);
    }

    public function test_participation_fails_if_wrong_type()
    {
        $this->setExpectedException(AssetMayNotParticipateInBuildOff::class);

        $asset = $this->createPark(false);

        $buildOff = factory(BuildOff::class)->create([
            'type_requirement' => 'blueprint'
        ]);

        $this->dispatch(new ParticipateInBuildOff($asset, $buildOff));
    }

    public function test_participation_fails_if_has_wrong_tag()
    {
        $this->setExpectedException(AssetMayNotParticipateInBuildOff::class);

        $asset = $this->createBlueprint(false);

        $tag = \TagRepo::findByTagName('Transport');

        $buildOff = factory(BuildOff::class)->create([
            'tag_id' => $tag->id
        ]);

        $this->dispatch(new ParticipateInBuildOff($asset, $buildOff));
    }
}