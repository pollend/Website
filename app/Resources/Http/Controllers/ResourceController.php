<?php

namespace PN\Resources\Http\Controllers;

use PN\Http\Controllers\Controller;

class ResourceController extends Controller
{
    public function images($filename)
    {
        return response(\Storage::disk('images')->get($filename), 200, [
            'Content-type' => 'image/jpeg'
        ]);
    }

    public function download($identifier)
    {

    }
}
