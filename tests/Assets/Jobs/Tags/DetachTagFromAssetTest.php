<?php

namespace Tests\Assets\Jobs\Tags;


use PN\Assets\Events\TagWasDetachedFromAsset;
use PN\Assets\Jobs\Tags\AttachTagToAsset;
use PN\Assets\Jobs\Tags\DetachTagFromAsset;
use PN\Assets\Tag;
use Tests\FactoryTrait;

class DetachTagFromAssetTest extends \TestCase
{
    use FactoryTrait;

    public function test_tag_detaches_from_asset()
    {
        $asset = $this->createAsset(false);

        $tag = factory(Tag::class)->create();

        $this->dispatch(app(AttachTagToAsset::class, [$asset, $tag]));

        $this->assertNotNull($asset->getTags()->find($tag->id));

        $this->dispatch(app(DetachTagFromAsset::class, [$asset, $tag]));

        // refresh from db
        $asset = \AssetRepo::find($asset->id);

        $this->assertNull($asset->getTags()->find($tag->id));
    }

    public function test_tag_detach_fires_event()
    {
        $this->expectsEvents(TagWasDetachedFromAsset::class);

        $asset = $this->createAsset(false);

        $tag = factory(Tag::class)->create();

        $this->dispatch(new AttachTagToAsset($asset, $tag));
        $this->dispatch(new DetachTagFromAsset($asset, $tag));
    }
}
