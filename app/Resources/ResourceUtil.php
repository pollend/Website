<?php

namespace PN\Resources;


use PN\Foundation\StorageUtil;
use PN\Resources\Exceptions\InvalidResource;
use PN\Resources\Extractors\BlueprintExtractor;
use PN\Resources\Extractors\ParkExtractor;
use PN\Resources\Validators\BlueprintValidator;
use PN\Resources\Validators\ParkValidator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ResourceUtil
{
    public function validate($resource)
    {
        if (\Request::hasFile($resource)) {
            $path = $this->moveToTmp(\Request::file($resource));
        } else {
            $path = $resource;
        }

        try {
            switch ($this->getTypeOf($resource)) {
                case "mod":
                    return true;
                case "blueprint":
                    return (new BlueprintValidator($path))->isValid();
                case "park":
                    return (new ParkValidator($path))->isValid();
                default:
                    return false;
            }
        } catch (InvalidResource $e) {
            return false;
        }
    }

    /**
     * Moves file to tmp dir
     *
     * @param UploadedFile $file
     * @return string
     */
    private function moveToTmp(UploadedFile $file)
    {
        $name = sha1(uniqid());

        $extension = $file->getClientOriginalExtension();

        \File::copy($file->getRealPath(), sys_get_temp_dir() . '/' . $name . '.' . $extension);

        return sys_get_temp_dir() . '/' . $name . '.' . $extension;
    }

    /**
     * Makes an resource object based on the parameter
     *
     * Can be: github url, key in file upload, path to file
     *
     * @param $source
     * @return Blueprint|Mod|Park
     * @throws InvalidResource
     */
    public function make($source)
    {
        $this->validate($source);

        if (\Request::hasFile($source)) {
            $source = $this->moveToTmp(\Request::file($source));
        }

        // little hack, but it works :)
        if (\File::exists($source)) {
            $source = $this->moveToTmp(new UploadedFile($source, basename($source)));
        }

        switch ($this->getTypeOf($source)) {
            case "blueprint":
                $resource = new Blueprint();
                break;
            case "park":
                $resource = new Park();
                break;
            case "mod":
                $resource = new Mod();
                break;
        }

        $resource->source = $source;
        $resource->overwriteImageWithDefault();

        return $resource;
    }

    /**
     * @param $resource
     * @return string
     * @throws InvalidResource
     */
    public function getTypeOf($resource)
    {
        if (\Request::hasFile($resource)) {
            $resource = $this->moveToTmp(\Request::file($resource));
        }

        if (!is_object($resource) && preg_match('/http(s?):\/\/github.com\/([a-zA-Z0-9-_]+)\/([a-zA-Z0-9-_]+)(\/?)/',
                $resource) == 1
        ) {
            return 'mod';
        } else {
            if ($resource instanceof \PN\Resources\Mod) {
                return 'mod';
            } else {
                if (is_object($resource)) {
                    switch (pathinfo($resource->source, PATHINFO_EXTENSION)) {
                        case 'png':
                            return 'blueprint';
                        case 'txt':
                            return 'park';
                    }
                } else {
                    if (\File::exists($resource)) {
                        switch (pathinfo($resource, PATHINFO_EXTENSION)) {
                            case 'png':
                                return 'blueprint';
                            case 'txt':
                                return 'park';
                        }
                    }
                }
            }
        }

        throw new InvalidResource($resource);
    }

    public function makeExtractor(ResourceInterface $resource)
    {
        if ($resource instanceof Blueprint) {
            return new BlueprintExtractor(StorageUtil::copyToTmp($resource->source));
        }

        if ($resource instanceof Park) {
            return new ParkExtractor(StorageUtil::copyToTmp($resource->source));
        }

        // if this happens to be a mod, return null
        return null;
    }

    /**
     * @param $argument
     * @return string
     */
    public function escapeArgument($argument)
    {
        return '"' . str_replace('"', '\\"', str_replace('\\', '\\\\', $argument)) . '"';
    }
}
