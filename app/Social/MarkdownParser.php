<?php

namespace PN\Social;

use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use League\CommonMark\Inline\Element\Text;
use PN\Social\Parsers\EmojiParser;
use PN\Social\Parsers\LinkParser;
use PN\Social\Parsers\UserParser;

class MarkdownParser
{
    public static function parse($content)
    {
        $key = 'markdown.' . sha1($content);

        return \Cache::remember($key, 1333333333337, function () use ($content) {
            $environment = Environment::createCommonMarkEnvironment();
            $environment->addInlineParser(new EmojiParser());
            $environment->addInlineParser(new UserParser());
            $environment->addInlineParser(new LinkParser());
            $parser = new DocParser($environment);
            $htmlRenderer = new HtmlRenderer($environment);
            $document = $parser->parse($content);
            // Replace all HtmlBlocks with paragraphs of text.
            $walker = $document->walker();
            while ($event = $walker->next()) {
                $node = $event->getNode();
                if (get_class($node) == 'League\CommonMark\Inline\Element\Html') {
                    $text = new Text();
                    $text->setContent($node->getContent());
                    $node->replaceWith($text);
                    $walker->resumeAt($text);
                }
                if (get_class($node) == 'League\CommonMark\Block\Element\HtmlBlock') {
                    $text = new Text();
                    $text->setContent(implode("\n", $node->getStrings()));
                    $paragraph = new Paragraph();
                    $paragraph->appendChild($text);
                    $node->replaceWith($paragraph);
                    $walker->resumeAt($paragraph);
                }
            }
            return $htmlRenderer->renderBlock($document);
        });
    }
}
