<?php

namespace Tests\Resources;


use PN\Resources\Image;

class ImageTest extends \TestCase
{
    public function test_image_can_be_made_of_raw()
    {
        $raw = file_get_contents(base_path('tests/files/blueprint.png'));

        $image = Image::make($raw);

        $this->assertInstanceOf(Image::class, $image);
    }

    public function test_image_has_same_raw()
    {
        $raw = file_get_contents(base_path('tests/files/blueprint.png'));

        $image = Image::make($raw);

        $this->assertEquals($raw, $image->getRaw());
    }
}
