<?php

namespace Tests\Assets\Jobs\Tags;


use PN\Assets\Jobs\Tags\AttachTagToAsset;
use PN\Assets\Jobs\Tags\DetachPrimaryTagsFromAsset;
use PN\Assets\Tag;
use Tests\FactoryTrait;

class DetachPrimaryTagsFromAssetTest extends \TestCase
{
    use FactoryTrait;

    public function test_primary_tags_are_detached()
    {
        $asset = $this->createBlueprint(false);

        $primary = Tag::where('type', $asset->type)->where('primary', 1)->first();

        $this->dispatch(app(AttachTagToAsset::class, [$asset, $primary]));
        $this->assertEquals(1, $asset->getTags()->count());

        // refresh asset from db
        $asset = \AssetRepo::find($asset->id);

        $this->dispatch(app(DetachPrimaryTagsFromAsset::class, [$asset]));
        $this->assertEquals(0, $asset->getTags()->count());
    }

    public function test_non_primary_tags_are_left_alone()
    {
        $asset = $this->createBlueprint(false);

        $nonPrimary = Tag::where('type', $asset->type)->where('primary', 0)->first();
        $primary = Tag::where('type', $asset->type)->where('primary', 1)->first();

        $this->dispatch(app(AttachTagToAsset::class, [$asset, $nonPrimary]));
        $this->dispatch(app(AttachTagToAsset::class, [$asset, $primary]));
        $this->assertEquals(2, $asset->getTags()->count());

        // refresh asset from db
        $asset = \AssetRepo::find($asset->id);
        
        $this->dispatch(app(DetachPrimaryTagsFromAsset::class, [$asset]));
        $this->assertEquals(1, $asset->getTags()->count());
    }
}
