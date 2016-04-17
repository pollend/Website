<?php

namespace Tests\Assets\Jobs\Tags;


use PN\Assets\Events\TagWasAttachedToAsset;
use PN\Assets\Jobs\Tags\AttachTagToAsset;
use PN\Assets\Tag;
use Tests\FactoryTrait;

class AttachTagToAssetTest extends \TestCase
{
    use FactoryTrait;

    public function test_tag_attaches_to_asset()
    {
        $asset = $this->createAsset(true);

        $tag = factory(Tag::class)->create();

        $this->dispatch(app(AttachTagToAsset::class, [$asset, $tag]));

        $this->assertNotNull($asset->getTags()->find($tag->id));
    }

    public function test_tag_attach_fires_event()
    {
        $this->expectsEvents(TagWasAttachedToAsset::class);

        $asset = $this->createAsset(true);

        $tag = factory(Tag::class)->create();

        $this->dispatch(app(AttachTagToAsset::class, [$asset, $tag]));
    }

    public function test_tag_cant_be_attached_twice()
    {
        $asset = $this->createAsset(true);

        $tag = factory(Tag::class)->create();

        $this->dispatch(app(AttachTagToAsset::class, [$asset, $tag]));

        $this->doesntExpectEvents(TagWasAttachedToAsset::class);

        $this->dispatch(app(AttachTagToAsset::class, [$asset, $tag]));
    }
}
