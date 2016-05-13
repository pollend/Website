<?php


namespace PN\Steam\Console;


use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Steam\Jobs\ScrapePages;

class ScrapeWorkshop extends Command
{
    use DispatchesJobs;

    /**
     * @var string
     */
    protected $signature = 'workshop:scrape';

    /**
     * @var string
     */
    protected $description = 'Starts the scraping process of workshop';

    /**
     * @return mixed
     */
    public function handle()
    {
        $this->dispatch(new ScrapePages());
    }
}