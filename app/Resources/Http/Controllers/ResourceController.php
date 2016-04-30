<?php

namespace PN\Resources\Http\Controllers;

use PN\Http\Controllers\Controller;

class ResourceController extends Controller
{
    public function images($size, $filename)
    {
        return response(\Storage::disk('images')->get($size.'/'.$filename), 200, [
            'Content-type' => 'image/jpeg'
        ]);
    }

    public function avatars($filename)
    {
        return response(\Storage::disk('avatars')->get($filename), 200, [
            'Content-type' => 'image/jpeg'
        ]);
    }
}
