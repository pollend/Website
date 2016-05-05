<?php

namespace PN\Media\Http\Controllers;

use PN\Foundation\Http\Controllers\Controller;
use PN\Media\Http\Requests\UpdateScreenshotRequest;
use PN\Media\Jobs\UpdateScreenshot;

class ScreenshotController extends Controller
{
    public function index()
    {
        $screenshots = \ScreenshotRepo::descended(true);

        return view('screenshots.index', compact(
            'screenshots'
        ));
    }

    public function show($identifier, $slug)
    {
        $screenshot = \ScreenshotRepo::findByIdentifier($identifier);

        return view('screenshots.show', compact(
            'screenshot'
        ));
    }

    public function edit($identifier)
    {
        $screenshot = \ScreenshotRepo::findByIdentifier($identifier);

        abort_if(\Gate::denies('update', [$screenshot]), 401);

        return view('screenshots.edit', compact(
            'screenshot'
        ));
    }

    public function update($identifier, UpdateScreenshotRequest $request)
    {
        $screenshot = \ScreenshotRepo::findByIdentifier($identifier);

        abort_if(\Gate::denies('update', [$screenshot]), 401);

        $this->dispatch(new UpdateScreenshot($screenshot, request('title')));

        return redirect($screenshot->getPresenter()->url);
    }

    public function delete($identifier)
    {
        $screenshot = \ScreenshotRepo::findByIdentifier($identifier);

        abort_if(\Gate::denies('delete', [$screenshot]), 401);

        \ScreenshotRepo::remove($screenshot);

        return redirect(route('screenshots.index'));
    }

    public function random()
    {
        $screenshot = \ScreenshotRepo::random();

        return redirect($screenshot->getPresenter()->url());
    }
}