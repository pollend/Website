<?php


namespace PN\Social\Parsers;


use League\CommonMark\Inline\Element\Image;
use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\InlineParserContext;

class EmojiParser extends AbstractInlineParser
{
    /**
     * @var array
     */
    private $map = [
            // http://twitter.github.io/twemoji/preview.html
            ['code' => '1f44b', 'strings' => [':wave:']],
            ['code' => '1f44d', 'strings' => [':+1:', ':like:']],
            ['code' => '1f44e', 'strings' => [':-1:', ':dislike:']],
            ['code' => '1f600', 'strings' => [':)', ':-)']],
            ['code' => '1f603', 'strings' => [':D', ':-D']],
            ['code' => '1f606', 'strings' => ['xD', 'x-D', 'XD', 'X-D']],
            ['code' => '1f612', 'strings' => [':(', ':-(']],
            ['code' => '1f61b', 'strings' => [':P', ':p']],
            ['code' => '1f61c', 'strings' => [';P', ';p']],
            ['code' => '1f61d', 'strings' => ['xP', 'XP']],
            ['code' => '1f625', 'strings' => [':\'(', ':`(', ':’(', ':‛(']],
            ['code' => '1f62d', 'strings' => ['T_T']],
            ['code' => '1f62e', 'strings' => [':o', ':O']],
        ];

    /**
     * @var array
     */
    private $firstChars;
    /**
     * EmojiParser constructor.
     */
    public function __construct()
    {
        $this->firstChars = array_unique(
            call_user_func_array('array_merge',
                array_map(function ($e) {
                    return array_map(function ($f) {
                        return $f[0];
                    }, $e['strings']);
                }, $this->map)
            )
        );
    }

    /**
     * @return array
     */
    public function getCharacters()
    {
        return $this->firstChars;
    }

    /**
     * @param InlineParserContext $inlineContext
     * @return bool
     */
    public function parse(InlineParserContext $inlineContext)
    {
        $cursor = $inlineContext->getCursor();
        $nextChar = $cursor->peek();
        foreach ($this->map as $emoji) {
            foreach ($emoji['strings'] as $string) {
                $matches = true;
                for ($i = 0; $i < strlen($string); $i++) {
                    if ($string[$i] !== $cursor->peek($i)) {
                        $matches = false;
                        break;
                    }
                }
                if (!$matches) {
                    continue;
                }
                $cursor->advanceBy(strlen($string));
                $inlineContext->getContainer()->appendChild(new Image('/img/emoji/36x36/' . $emoji['code'] . '.png'));
                return true;
            }
        }
        return false;
    }
}