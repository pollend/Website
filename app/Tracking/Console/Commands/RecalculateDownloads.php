<?php

namespace PN\Tracking\Console\Commands;

use Illuminate\Console\Command;
use PN\Tracking\Download;

class RecalculateDownloads extends Command
{
    /**
     * @var string
     */
    protected $signature = 'downloads:recalculate';

    /**
     * @var string
     */
    protected $description = 'Recalculates the downloads on everything that is downloadable';

    /**
     * @return mixed
     */
    public function handle()
    {
        $downloads = \DB::select('select count(id) as downloads, downloadable_id, downloadable_type from (select *, date(created_at) as d from downloads group by ip, d, downloadable_type, downloadable_id) as tmp group by downloadable_type, downloadable_id');

        foreach($downloads as $download) {
            $downloadable = app($download->downloadable_type)->withTrashed()->find($download->downloadable_id);

            if($downloadable != null) {
                $downloadable->download_count = $download->downloads;
                $downloadable->timestamps = false;

                $downloadable->save();

                sleep(1);
            }
        }
    }
}
