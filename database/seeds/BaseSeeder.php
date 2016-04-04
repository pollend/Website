<?php

abstract class BaseSeeder extends \Illuminate\Database\Seeder
{
    use \Illuminate\Foundation\Bus\DispatchesJobs;

    public function getRandom($model, $criteria = [], $count = 1)
    {
        if ($count == 1) {
            return app($model)->where($criteria)->orderBy(DB::raw('RAND()'))->first();
        }

        return app($model)->where($criteria)->orderBy(DB::raw('RAND()'))->take($count)->get();
    }

    public function getRandomFile($dir)
    {
        $files = glob($dir . '/*.*');
        $file = array_rand($files);

        return $files[$file];
    }

    protected function createImage()
    {
        Config::set('filesystems.disks.image.root', sys_get_temp_dir());

        $image = \PN\Resources\Image::make(file_get_contents($this->getRandomFile(base_path('database/seeds/files/images'))));

        $image->save();

        return $image;
    }
}
