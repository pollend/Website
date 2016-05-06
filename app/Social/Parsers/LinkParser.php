<?php


namespace PN\Social\Parsers;


use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\InlineParserContext;

class LinkParser extends AbstractInlineParser
{
    /**
     * @return string[]
     */
    public function getCharacters()
    {
        return [
            'h'
        ];
    }

    /**
     * @param InlineParserContext $inlineContext
     *
     * @return bool
     */
    public function parse(InlineParserContext $inlineContext)
    {
        $cursor = $inlineContext->getCursor();
        // The link must not have any other characters immediately prior
        $previousChar = $cursor->peek(-1);
        if ($previousChar !== null && $previousChar !== ' ') {
            // peek() doesn't modify the cursor, so no need to restore state first
            return false;
        }

        // TODO tmp workaround
        if($cursor->peek(1) != 't' || $cursor->peek(2) != 't' || $cursor->peek(3) != 'p'){
            return false;
        }

        // Save the cursor state in case we need to rewind and bail
        $previousState = $cursor->saveState();
        // link match
        $link = $cursor->match('#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#iS');
        if (!empty($link)) {
            $domain = parse_url($link, PHP_URL_HOST);
            $path = parse_url($link, PHP_URL_PATH);
            if(strlen($path) > 30){
                $path = substr($path, 0, 10).'...'.substr($path, -10, 10);
            }
            $inlineContext->getContainer()->appendChild(new Link($link, $domain . $path, $link));
            return true;
        }
        // user does not exists or is not valid
        $cursor->restoreState($previousState);
        return false;
    }
}