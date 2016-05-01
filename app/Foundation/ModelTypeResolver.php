<?php


namespace PN\Foundation;


use PN\Assets\Asset;
use PN\Forum\Post;
use PN\Media\Screenshot;

class ModelTypeResolver
{
    private static $types = [
        'asset' => Asset::class,
        'post' => Post::class,
        'screenshot' => Screenshot::class
    ];

    public static function resolveType($model)
    {
        foreach (self::$types as $t => $m) {
            if($m == $model) {
                return $t;
            }
        }

        return null;
    }

    public static function resolveModel($type)
    {
        if(isset(self::$types[$type])) {
            return self::$types[$type];
        }

        return null;
    }
}