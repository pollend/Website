<?php

namespace PN\Tracking\Console\Commands;

use Illuminate\Console\Command;
use PN\Tracking\view;

class RecalculateViews extends Command
{
    /**
     * @var string
     */
    protected $signature = 'views:recalculate';

    /**
     * @var string
     */
    protected $description = 'Recalculates the views on everything that is viewable';

    /**
     * @return mixed
     */
    public function handle()
    {
        $views = \DB::select('select count(id) as views, viewable_id, viewable_type from (select *, date(created_at) as d from views group by ip, d, viewable_type, viewable_id) as tmp group by viewable_type, viewable_id');

        foreach($views as $views) {
            $viewable = app($views->viewable_type)->withTrashed()->find($views->viewable_id);

            if($viewable != null) {
                $viewable->view_count = $views->views;
                $viewable->timestamps = false;

                $viewable->save();
            }
        }
    }
}
