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
     * @return Resource|Mod|Park
     * @throws InvalidResource
     */
    public function make($source)
    {
        // little hack, but it works :)
        if (\File::exists($source)) {
            $source = $this->moveToTmp(new UploadedFile($source, basename($source)));
        }

        if (\Request::hasFile($source)) {
            $source = $this->moveToTmp(\Request::file($source));
        }

        $resource = new Resource();

        $resource->setSource($source);
        $resource->setDefaultImage();

        if(!$resource->getValidator()->isValid()) {
            throw new InvalidResource($resource);
        }

        return $resource;
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
