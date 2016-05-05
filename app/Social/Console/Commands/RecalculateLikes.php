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

        foreach($likes as $like) {
            $likeable = app($like->likeable_type)->withTrashed()->find($like->likeable_id);

            $likeable->like_count = $like->likes;
            $likeable->timestamps = false;

            $likeable->save();
        }
    }
}
