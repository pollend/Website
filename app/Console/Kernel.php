<?php

namespace PN\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use PN\Foundation\Console\Inspire;
use PN\Social\Console\Commands\RecalculateLikes;
use PN\Tracking\Console\Commands\RecalculateDownloads;
use PN\Tracking\Console\Commands\RecalculateViews;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Inspire::class,
        RecalculateDownloads::class,
        RecalculateViews::class,
        RecalculateLikes::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }
}
