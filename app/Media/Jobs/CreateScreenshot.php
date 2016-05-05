<?php


namespace PN\Media\Jobs;


use PN\Jobs\Job;
use PN\Media\Image;
use PN\Media\Screenshot;
use PN\Users\User;

/**
 * Class CreateScreenshot
 * @package PN\Media\Jobs
 */
class CreateScreenshot extends Job
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Image
     */
    private $image;

    /**
     * @var string
     */
    private $title;

    /**
     * CreateScreenshot constructor.
     * @param User $user
     * @param Image $image
     * @param string $title
     */
    public function __construct(User $user, Image $image, string $title)
    {
        $this->user = $user;
        $this->image = $image;
        $this->title = $title;
    }

    public function handle() : Screenshot
    {
        $screenshot = new Screenshot();
        
        $screenshot->setUser($this->user);
        $screenshot->setImage($this->image);
        $screenshot->title = $this->title;

        \ScreenshotRepo::add($screenshot);

        return $screenshot;
    }
}
