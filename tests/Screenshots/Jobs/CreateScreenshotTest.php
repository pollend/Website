<?php


namespace Tests\Screenshots\Jobs;


use Illuminate\Http\UploadedFile;
use Tests\FactoryTrait;

class CreateScreenshotTest extends \TestCase
{
    use FactoryTrait;

    public function test_create()
    {
        $this->login();

        $this->call('POST', 'api/screenshot/create', [
            'title' => 'Nice screenie mate'
        ], [], [
            'screenshot' => new UploadedFile(base_path('tests/files/image.jpg'), 'image.jpg')
        ], [
            'Authorization' => $this->user->api_key
        ]);

        $this->seeInDatabase('screenshots', [
            'title' => 'Nice screenie mate'
        ]);
    }
}