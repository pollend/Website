<?php

namespace Tests\Assets\Jobs;


use PN\Assets\Jobs\SetPrimaryTags;
use Tests\FactoryTrait;

class SetPrimaryTagsTest extends \TestCase
{
    use FactoryTrait;

    public function test_tags_are_attached()
    {
        $asset = $this->createBlueprint(false);

        $this->dispatch(app(SetPrimaryTags::class, [$asset]));

        $this->assertNotEquals(0, $asset->getTags()->count());
    }
}
