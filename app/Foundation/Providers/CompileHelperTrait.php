<?php


namespace PN\Foundation\Providers;


trait CompileHelperTrait
{
    public static function filesInFolder(string $folder, array $excluded = [])
    {
        $files = [];

        $scans = scandir($folder);

        foreach ($scans as $scan) {
            if(is_file($folder . '/' . $scan) && !in_array($scan, $excluded)) {
//                str_replace(base_path(), $)
                $files[] = $folder . '/' . $scan;
            }
        }

        return $files;
    }
}