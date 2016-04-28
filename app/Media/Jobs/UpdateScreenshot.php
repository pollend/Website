<?php


namespace PN\Media\Jobs;


use PN\Jobs\Job;
use PN\Media\Screenshot;

/**
 * Class UpdateScreenshot
 * @package PN\Media\Jobs
 */
class UpdateScreenshot extends Job
{
    /**
     * @var Screenshot
     */
    private $screenshot;

    /**
     * @var string
     */
    private $title;

    /**
     * UpdateScreenshot constructor.
     * @param Screenshot $screenshot
     * @param string $title
     */
    public function __construct(Screenshot $screenshot, string $title)
    {
        $this->screenshot = $screenshot;
        $this->title = $title;
    }

    public function handle() : Screenshot
    {
        $this->screenshot->title = $this->title;

        \ScreenshotRepo::edit($this->screenshot);

        return $this->screenshot;
    }
}