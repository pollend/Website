<?php

namespace Tests\Resources;


use PN\Resources\Blueprint;
use PN\Resources\Exceptions\InvalidResource;
use PN\Resources\Mod;
use PN\Resources\Park;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ResourceUtilTest extends \TestCase
{
    public function test_blueprint_can_be_made_from_upload()
    {
        $this->call('POST', route('assets.manage.selectfile'), [], [], [
            'file' => new UploadedFile(base_path('tests/files/blueprint.png'), 'blueprint.png')
        ]);

        $this->assertInstanceOf(Blueprint::class, \ResourceUtil::make('file'));
    }

    public function test_park_can_be_made_from_upload()
    {
        $this->call('POST', route('assets.manage.selectfile'), [], [], [
            'file' => new UploadedFile(base_path('tests/files/park.txt'), 'park.txt')
        ]);

        $this->assertInstanceOf(Park::class, \ResourceUtil::make('file'));
    }

    public function test_mod_can_be_made_from_upload()
    {
        $this->assertInstanceOf(Mod::class, \ResourceUtil::make('https://github.com/ParkitectNexus/Website'));
    }

    public function test_make_throws_exception_when_given_invalid_source()
    {
        $this->setExpectedException(InvalidResource::class);

        \ResourceUtil::make('file');
    }

    public function test_blueprint_validates()
    {
        $this->call('POST', route('assets.manage.selectfile'), [], [], [
            'file' => new UploadedFile(base_path('tests/files/park.txt'),
                'park.txt')
        ]);

        $this->assertInstanceOf(Park::class, \ResourceUtil::make('file'));
    }

    public function test_park_validates()
    {
        $this->assertTrue(\ResourceUtil::validate(base_path('tests/files/park.txt')));
    }

    public function test_mod_validates()
    {
        $this->assertTrue(\ResourceUtil::validate('https://github.com/ParkitectNexus/Website'));
    }

    public function test_blueprint_validates_on_file_upload()
    {
        $this->call('POST', route('assets.manage.selectfile'), [], [], [
            'file' => new UploadedFile(base_path('tests/files/blueprint.png'), 'blueprint.png')
        ]);

        $this->assertTrue(\ResourceUtil::validate('file'));
    }

    public function test_park_validates_on_file_upload()
    {
        $this->call('POST', route('assets.manage.selectfile'), [], [], [
            'file' => new UploadedFile(base_path('tests/files/park.txt'), 'park.txt')
        ]);

        $this->assertTrue(\ResourceUtil::validate('file'));
    }
}
