<?php


namespace PN\Social\Parsers;


use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\InlineParserContext;

class UserParser extends AbstractInlineParser
{
    public function getCharacters()
    {
        return array('@');
    }

    public function parse(InlineParserContext $inlineContext)
    {
        $cursor = $inlineContext->getCursor();

        // The @ symbol must not have any other characters immediately prior
        $previousChar = $cursor->peek(-1);
        if ($previousChar !== null && $previousChar !== ' ') {
            // peek() doesn't modify the cursor, so no need to restore state first
            return false;
        }

        // Save the cursor state in case we need to rewind and bail
        $previousState = $cursor->saveState();

        // Advance past the @ symbol to keep parsing simpler
        $cursor->advance();

        // Parse the handle
        $username = $cursor->match('/[a-zA-Z0-9-]+/');
        if (!empty($username)) {
            // check if users exists
            $user = \UserRepo::findByUsername($username);

            if($user != null) {
                $profileUrl = $user->getPresenter()->url();

                $inlineContext->getContainer()->appendChild(new Link($profileUrl, '@' . $user->username));

                return true;
            }
        }

        // user does not exists or is not valid
        $cursor->restoreState($previousState);

        return false;
    }
}