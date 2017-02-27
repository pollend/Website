<?php namespace PN\Steam\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use PN\Jobs\Job;

class QueryWorkshop extends Job implements ShouldQueue
{
    public function __construct()
    {

    }

    public function handle()
    {

    }
    protected function getURI($key,$page,$numberPerPage)
    {
       return "https://api.steampowered.com/IPublishedFileService/QueryFiles/v1/?key=".$key."&format=json&page=".$page."&numperpage=".$numberPerPage."&appid=453090&return_vote_data=1&return_tags=1&return_kv_tags=1&return_previews=1&return_short_description=1&return_metadata=1";
    }
}
