<?php

namespace OllieCodes\Etched;

use League\CommonMark\Block\Element\BlockQuote;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\Block\Element\ListBlock;
use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\Block\Element\ThematicBreak;
use League\CommonMark\Block\Renderer\BlockQuoteRenderer;
use League\CommonMark\Block\Renderer\FencedCodeRenderer;
use League\CommonMark\Block\Renderer\HeadingRenderer;
use League\CommonMark\Block\Renderer\IndentedCodeRenderer;
use League\CommonMark\Block\Renderer\ListBlockRenderer;
use League\CommonMark\Block\Renderer\ListItemRenderer;
use League\CommonMark\Block\Renderer\ParagraphRenderer;
use League\CommonMark\Block\Renderer\ThematicBreakRenderer;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Inline\Element\Code;
use League\CommonMark\Inline\Element\Emphasis;
use League\CommonMark\Inline\Element\HtmlInline;
use League\CommonMark\Inline\Element\Image;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Element\Newline;
use League\CommonMark\Inline\Element\Strong;
use League\CommonMark\Inline\Element\Text;
use League\CommonMark\Inline\Renderer\CodeRenderer;
use League\CommonMark\Inline\Renderer\EmphasisRenderer;
use League\CommonMark\Inline\Renderer\HtmlInlineRenderer;
use League\CommonMark\Inline\Renderer\ImageRenderer;
use League\CommonMark\Inline\Renderer\LinkRenderer;
use League\CommonMark\Inline\Renderer\NewlineRenderer;
use League\CommonMark\Inline\Renderer\StrongRenderer;
use League\CommonMark\Inline\Renderer\TextRenderer;
use OllieCodes\Etched\Blocks\Renderer\BlockBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\InlineBladeRenderer;

class EtchedRenderers
{
    public static function register(ConfigurableEnvironmentInterface $environment, array $extensions): void
    {
        // Block renderers
        self::block($environment, BlockQuote::class, BlockQuoteRenderer::class, 'blockquote');
        self::block($environment, FencedCode::class, FencedCodeRenderer::class, 'code.fenced');
        self::block($environment, Heading::class, HeadingRenderer::class, 'heading', true);
        self::block($environment, IndentedCode::class, IndentedCodeRenderer::class, 'code.indented');
        self::block($environment, ListBlock::class, ListBlockRenderer::class, 'list.block');
        self::block($environment, ListItem::class, ListItemRenderer::class, 'list.item');
        self::block($environment, Paragraph::class, ParagraphRenderer::class, 'paragraph');
        self::block($environment, ThematicBreak::class, ThematicBreakRenderer::class, 'thematic-break');

        // Item renderers
        self::inline($environment, Code::class, CodeRenderer::class, 'inline.code');
        self::inline($environment, Emphasis::class, EmphasisRenderer::class, 'inline.emphasis');
        self::inline($environment, HtmlInline::class, HtmlInlineRenderer::class, 'inline.html');
        self::inline($environment, Image::class, ImageRenderer::class, 'inline.image');
        self::inline($environment, Link::class, LinkRenderer::class, 'inline.link');
        self::inline($environment, Newline::class, NewlineRenderer::class, 'inline.newline');
        self::inline($environment, Strong::class, StrongRenderer::class, 'inline.strong');
        self::inline($environment, Text::class, TextRenderer::class, 'inline.text');

        // Extension specific renderers
        // - dunno
    }

    private static function block(ConfigurableEnvironmentInterface $environment, string $blockClass, string $rendererClass, string $name, bool $suffixTag = false): void
    {
        $environment->addBlockRenderer($blockClass, new BlockBladeRenderer(new $rendererClass, $name, $suffixTag));
    }

    private static function inline(ConfigurableEnvironmentInterface $environment, string $inlineClass, string $rendererClass, string $name, bool $suffixTag = false): void
    {
        $environment->addInlineRenderer($inlineClass, new InlineBladeRenderer(new $rendererClass, $name, $suffixTag));
    }
}