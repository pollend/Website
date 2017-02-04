<?php


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Media\Image;
use PN\Media\Jobs\CreateScreenshot;
use PN\Media\Screenshot;
use PN\Users\User;


class CreateScreenShotTest extends \Codeception\Test\Unit
{
    use DispatchesJobs;
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testCreateScreenshot()
    {
        //arrange
        $user = \Mockery::mock(User::class)->makePartial();
        $user->id = 100;
        $image = \Mockery::mock(Image::class)->makePartial();
        $image->id = 20;

        \ScreenshotRepo::shouldReceive("add")->with(\Mockery::type(Screenshot::class))->once();

        //act
        $screenShot = $this->dispatch(new CreateScreenshot($user, $image, "some_title"));

        //assert
        $this->assertInstanceOf(Screenshot::class, $screenShot);
        $this->assertTrue($screenShot->user_id == 100);
        $this->assertTrue($screenShot->image_id == 20);
    }


}