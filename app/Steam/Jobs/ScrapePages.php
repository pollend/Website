<?php


namespace PN\Steam\Jobs;


use Illuminate\Contracts\Queue\ShouldQueue;
use PN\Jobs\Job;

class ScrapePages extends Job implements ShouldQueue
{
    public function handle()
    {
        $url = 'http://steamcommunity.com/workshop/browse/?appid=453090&browsesort=mostrecent&section=readytouseitems';

        $crawler = \Goutte::request('GET', $url);

        $highest = 0;

        // get the number of pages
        $crawler->filter('.workshopBrowsePagingControls a')->each(function ($node) use (&$highest) {
            if ((int)$node->text() > $highest) {
                $highest = (int)$node->text();
            }
        });

        // for every page, scrape the page
        for ($i = 1; $i <= $highest; $i++) {
            $this->dispatch(new ScrapePage("http://steamcommunity.com/workshop/browse/?appid=453090&actualsort=trend&p=" . $i));
        }
    }
}