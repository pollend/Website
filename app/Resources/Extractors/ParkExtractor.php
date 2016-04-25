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
        return \Cache::remember('resource.extract.park.' . $this->path, 10, function () {
            $arguments = escapeshellarg(app_path('../bin/ParkitectNexus.AssetTools.exe')) . " savegame " .
                "--input " . \ResourceUtil::escapeArgument($this->path);

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $result = exec("$arguments", $lines, $errorCode);
            } else {
                $result = exec("PATH=\$PATH:/usr/local/bin; mono $arguments 2>&1", $lines, $errorCode);
            }

            if ($result == null || $errorCode != 0) {
                throw new NotAValidPark($this->path);
            }

            $json = json_decode($result, true);

            if ($json == null) {
                throw new NotAValidPark($this->path);
            }
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
