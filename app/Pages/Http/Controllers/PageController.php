<?php


namespace PN\Pages\Http\Controllers;


use PN\Foundation\Http\Controllers\Controller;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = \PageRepo::findByslug($slug);

        return view('pages.show', compact('page'));
    }
}