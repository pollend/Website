<?php


namespace PN\Assets\Console;


use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Assets\Asset;
use PN\Assets\Jobs\SetPrimaryTags;
use PN\Assets\Jobs\Tags\DetachPrimaryTagsFromAsset;
use PN\Resources\Resource;

class ResetAllPrimaryTags extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:primary-tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Redo all resources' primary tags (delete and add)";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $assets = Asset::all();

        foreach ($assets as $asset) {
            if($asset->getResource() == null) {
                continue;
            }

            $this->dispatch(new DetachPrimaryTagsFromAsset($asset));

            $this->dispatch(new SetPrimaryTags($asset));
        }
    }
}