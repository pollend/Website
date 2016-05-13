<?php


namespace PN\Steam\Jobs;


use Illuminate\Contracts\Queue\ShouldQueue;
use PN\Assets\Jobs\CreateAsset;
use PN\Jobs\Job;
use PN\Media\Image;
use PN\Resources\Jobs\StoreResource;

class ScrapeBlueprint extends Job implements ShouldQueue
{
    private $url;

    /**
     * ScrapeBlueprint constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function handle()
    {
        $user = \UserRepo::find(env('STEAM_WORKSHOP_USER_ID'));

        $crawler = \Goutte::request('GET', $this->url);

        // get the url of the blupe
        $url = $crawler->filter('.workshopItemPreviewImageMain > a, #highlight_player_area > a')->first()->attr('onclick');

        // get workshop name
        $name = $crawler->filter('.workshopItemTitle')->first()->text();

        // generate a new description with workshop import info header
        $description = "Automatic imported from workshop\n\n Original source: {$this->url} \n\n ------ \n\n";
        // place original description under it
        $description .= str_replace("\r", "\n\n", $crawler->filter('.workshopItemDescription')->first()->text());

        // get the whole album of the resource
        $imgs = [];
        $crawler->filter('#highlight_strip_scroll img:not(.movie_thumb)')->each(function ($node) use(&$imgs){
            // imgs are sized 116, 65. get them in full size
            $src = str_replace('|116:65', '', $node->attr('src'));

            $imgs[] = file_get_contents($src);
        });

        // parse the blueprint url out of the onclick attribute
        preg_match('/[\w]+\( \'(.*)\' \);/', $url, $matches);
        $blueprintUrl = $matches[1];

        try {
            // create tmp file to download blueprint to
            $tmp = storage_path('tmp/' . uniqid() . '.png');

            // download blueprint to tmp location
            file_put_contents($tmp, file_get_contents($blueprintUrl));

            // make resource, this will fail if it's not a resource
            $resource = $this->dispatch(new StoreResource(\ResourceUtil::make($tmp)));

            // now that we have a resource, we can create the asset on parsed info
            $asset = $this->dispatch(new CreateAsset(
                $resource,
                $user,
                $name,
                $description
            ));

            // if workshop had atleast 1 image, set the first as thumbnail and shift it out of the array
            if(count($imgs) > 0){
                $img = Image::createFromData(array_shift($imgs));

                $asset->setImage($img);
            }

            // add all remaining images as album
            foreach ($imgs as $albumImage) {
                $img = Image::createFromData($albumImage);

                $asset->addImage($img);
            }

            // save edited asset
            \AssetRepo::edit($asset);
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }
}