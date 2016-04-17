<?php


namespace Tests\Media\Jobs;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Media\Image;
use PN\Media\Jobs\CreateImageFromRaw;

class CreateImageFromRawTest extends \TestCase
{
    use DispatchesJobs;

    public function test_image_can_be_made_of_raw()
    {
        $raw = file_get_contents(base_path('tests/files/blueprint.png'));

        $image = $this->dispatch(new CreateImageFromRaw($raw));

        $this->assertInstanceOf(Image::class, $image);
    }

    public function test_image_has_same_raw()
    {
        $raw = file_get_contents(base_path('tests/files/blueprint.png'));

        $image = $this->dispatch(new CreateImageFromRaw($raw));

        $this->assertEquals($raw, $image->getRaw());
    }
}