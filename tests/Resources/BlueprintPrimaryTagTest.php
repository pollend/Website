<?php


namespace Tests\Resources;


use PN\Resources\Jobs\CreateResource;
use Tests\FactoryTrait;

class BlueprintPrimaryTagTest extends \TestCase
{
    use FactoryTrait;

    public function test_old_style()
    {
        $resource = $this->dispatch(new CreateResource(base_path('tests/files/blueprints/old_style.png')));

        $primaryTags = $resource->getPrimaryTags();

        $this->assertTrue($primaryTags->contains("HasCoaster"));
        $this->assertTrue($primaryTags->contains("RollerCoaster"));
        $this->assertTrue($primaryTags->contains("WoodenCoaster"));
    }

    public function test_new_style()
    {
        $resource = $this->dispatch(new CreateResource(base_path('tests/files/blueprints/new_style.png')));

        $primaryTags = $resource->getPrimaryTags();
        
        $this->assertTrue($primaryTags->contains("HasScenery"));
        $this->assertTrue($primaryTags->contains("HasCoaster"));
        $this->assertTrue($primaryTags->contains("RollerCoaster"));
        $this->assertTrue($primaryTags->contains("LogFlume"));
    }

    public function test_scenery()
    {
        $resource = $this->dispatch(new CreateResource(base_path('tests/files/blueprints/scenery.png')));

        $primaryTags = $resource->getPrimaryTags();

        $this->assertTrue($primaryTags->contains("HasScenery"));
        $this->assertTrue($primaryTags->contains("HasOnlyScenery"));
    }

    public function test_scenery_flatride()
    {
        $resource = $this->dispatch(new CreateResource(base_path('tests/files/blueprints/scenery_flatride.png')));

        $primaryTags = $resource->getPrimaryTags();

        $this->assertTrue($primaryTags->contains("HasScenery"));
        $this->assertTrue($primaryTags->contains("HasFlatRide"));
    }
}