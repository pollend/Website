<?php


namespace PN\BuildOffs\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\BuildOffs\Jobs\RankBuildOff;

class RankBuildOffs extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buildoffs:rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Closes all buildoffs that are overdue';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $buildOffs = \BuildOffRepo::overdue();

        foreach ($buildOffs as $buildOff) {
            $this->dispatch(new RankBuildOff($buildOff));

            echo sprintf("Ranked %s", $buildOff->name);
        }
    }
}