<?php

namespace PN\Foundation;


class StorageUtil
{
    public static function copyToTmp($path)
    {
        if (!\File::isDirectory(dirname(storage_path('tmp/' . $path)))) {
            \File::makeDirectory(dirname(storage_path('tmp/' . $path)), 493, true);
        }

        \File::put(storage_path('tmp/' . $path), \Storage::disk()->get($path));

        return storage_path('tmp/' . $path);
    }
}
