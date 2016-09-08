<?php

namespace PN\Resources\Extractors;


use Illuminate\Support\Collection;
use PN\Resources\Exceptions\NotAValidPark;
use PN\Resources\Extractors\Stats\ParkStatConverter;

class ParkExtractor implements ExtractorInterface
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getData()
    {
        $md5 = hash_file('md5', $this->path);

        return \Cache::remember('resource.extract.park.' . $md5, 10, function () {
            // todo, delete this quick hack to support .park
            if(ends_with($this->path, '.park') || ends_with($this->path, '.scenario') ) {
                $gz = gzopen($this->path, 'rb');

                if (!$gz) {
                    throw new \UnexpectedValueException(
                        'Could not open gzip file'
                    );
                }

                $newSource = str_replace('.park', '.txt', $this->path);
                $newSource = str_replace('.scenario', '.txt', $newSource);

                $dest = fopen($newSource, 'wb');

                if (!$dest) {
                    gzclose($gz);
                    throw new \UnexpectedValueException(
                        'Could not open destination file'
                    );
                }

                stream_copy_to_stream($gz, $dest);

                gzclose($gz);
                fclose($dest);

                $this->path = $newSource;
            }

            $arguments = escapeshellarg(app_path('../bin/ParkitectNexus.AssetTools.exe')) . " savegame " .
                "--input " . \ResourceUtil::escapeArgument($this->path);

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $result = exec("$arguments", $lines, $errorCode);
            } else {
                $result = exec("PATH=\$PATH:/usr/local/bin; mono $arguments 2>&1", $lines, $errorCode);
            }

            if ($result == null || $errorCode != 0) {
                throw new NotAValidPark(sprintf('Error: %s, path: ', $result, $this->path));
            }

            $json = json_decode($result, true);

            if ($json == null) {
                throw new NotAValidPark($this->path);
            }

            unlink($this->path);

            return $json;
        });
    }

    public function getStats() : Collection
    {
        $parkConverter = new ParkStatConverter();

        return $parkConverter->convert($this->getData());
    }

    public function getName() : string
    {
        return $this->getData()['Header']['Name'];
    }
}
