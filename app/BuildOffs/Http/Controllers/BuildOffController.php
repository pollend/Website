<?php


namespace PN\BuildOffs\Http\Controllers;


use PN\Foundation\Http\Controllers\Controller;

class BuildOffController extends Controller
{
    public function index()
    {
        $buildOffs = \BuildOffRepo::descended();
    }
}