<?php


namespace Tests\Resources;


use PN\Resources\Jobs\CreateResource;
use Tests\FactoryTrait;

class ParkPrimaryTagTest extends \TestCase
{
    use FactoryTrait;

    public function test_park()
    {
        $resource = $this->dispatch(new CreateResource(base_path('tests/files/park.txt')));

        $primaryTags = $resource->getPrimaryTags();

        $this->assertEmpty($primaryTags->toArray());
    }
}