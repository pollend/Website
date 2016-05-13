<?php


namespace PN\Steam\Jobs;


use Illuminate\Contracts\Queue\ShouldQueue;
use PN\Jobs\Job;

class ScrapePage extends Job implements ShouldQueue
{
    private $url;

    /**
     * ScrapePage constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function handle()
    {
        $crawler = \Goutte::request('GET', $this->url);

        $blupes = [];

        // get the urls of each resource
        $crawler->filter('#profileBlock .workshopItem > a')->each(function($node) use (&$blupes){
            $blupes[] = $node->attr('href');
        });

        $blupes = array_unique($blupes);

        // foreach url, create an asset out of it
        foreach ($blupes as $blupe) {
            $this->dispatch(new ScrapeBlueprint($blupe));
        }
    }
}