<?php


namespace Tests\Resources;


use PN\Resources\Jobs\CreateResource;
use Tests\FactoryTrait;

class ModPrimaryTagTest extends \TestCase
{
    use FactoryTrait;

    public function test_park()
    {
        $resource = $this->dispatch(new CreateResource("https://github.com/ParkitectNexus/CoasterCam"));

        $primaryTags = $resource->getPrimaryTags();

        $this->assertEmpty($primaryTags->toArray());
    }
}