<?php


namespace PN\Media\Http\Controllers\Api;


use PN\Foundation\Http\Controllers\Controller;
use PN\Media\Image;
use PN\Media\Jobs\CreateScreenshot;

class ApiScreenshotController extends Controller
{
    public function create()
    {
        $image = Image::createFromData(file_get_contents(\Request::file('screenshot')->getRealPath()));

        $user = \UserRepo::findByApiKey(\Request::header('Authorization'));

        $this->dispatch(new CreateScreenshot($user, $image, request('title')));
    }
}