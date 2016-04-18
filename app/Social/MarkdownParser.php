<?php

namespace PN\Social;

use League\CommonMark\CommonMarkConverter;

class MarkdownParser
{
    public static function parse($text) {
        $key = 'markdown.' . sha1($text);

        return \Cache::remember($key, 1333333333337, function() use ($text) {
            $converter = new CommonMarkConverter();

            return $converter->convertToHtml($text);
        });
}
}
