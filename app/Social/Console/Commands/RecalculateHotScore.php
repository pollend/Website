<?php


namespace PN\Social\Console\Commands;


use Illuminate\Console\Command;

class RecalculateHotScore extends Command
{
    /**
     * @var string
     */
    protected $signature = 'score:recalculate';

    /**
     * @var string
     */
    protected $description = 'Recalculates the score on assets';

    /**
     * @return mixed
     */

    public function handle()
    {
        foreach (\AssetRepo::all() as $asset) {
            $this->calcRating($asset);
        }
    }

    public function calcRating($item)
    {
        $item->hot_score = $this->score($item->like_count, 0, $item->created_at);

        \AssetRepo::edit($item);
    }
    
    private function score($ups, $downs, $created)
    {
        $decay = env('HOT_SCORE_DECAY', 3000);
        $s = $ups - $downs;
        $order = log(max(abs($s), 1)) / 2.302585092994046;
        if ($s > 0) {
            $sign = 1;
        } else {
            if ($s < 0) {
                $sign = -1;
            } else {
                $sign = 0;
            }
        }
        $secAge = (strtotime('now') - strtotime($created->format('Y-m-d H:i:s')));
        return $sign * $order - $secAge / $decay;
    }
}