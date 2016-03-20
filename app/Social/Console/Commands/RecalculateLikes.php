<?php

namespace PN\Social\Console\Commands;


use Illuminate\Console\Command;

class RecalculateLikes extends Command
{
    /**
     * @var string
     */
    protected $signature = 'likes:recalculate';

    /**
     * @var string
     */
    protected $description = 'Recalculates the likes on everything that is likeable';

    /**
     * @return mixed
     */
    public function handle()
    {
        $likes = \DB::select('select sum(weight) as likes, likeable_id, likeable_type from likes group by likeable_type, likeable_id');

        foreach($likes as $likes) {
            $likeable = app($likes->likeable_type)->find($likes->likeable_id);

            $likeable->likes = $likes->likes;

            $likeable->save();
        }
    }
}
