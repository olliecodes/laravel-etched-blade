<?php

namespace OllieCodes\Etched;

use League\CommonMark\Block\Element\BlockQuote;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\Block\Element\HtmlBlock;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\Block\Element\ListBlock;
use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\Block\Element\ThematicBreak;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Inline\Element\Code;
use League\CommonMark\Inline\Element\Emphasis;
use League\CommonMark\Inline\Element\HtmlInline;
use League\CommonMark\Inline\Element\Image;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Element\Newline;
use League\CommonMark\Inline\Element\Strong;
use League\CommonMark\Inline\Element\Text;
use OllieCodes\Etched\Blocks\Renderer\BlockQuoteBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\FencedCodeBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\HeadingBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\HtmlBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\IndentedCodeBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\ListBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\ListItemBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\ParagraphBladeRenderer;
use OllieCodes\Etched\Blocks\Renderer\ThematicBreakBladeRenderer;
use OllieCodes\Etched\Inline\Renderer\CodeBladeRenderer;
use OllieCodes\Etched\Inline\Renderer\EmphasisBladeRenderer;
use OllieCodes\Etched\Inline\Renderer\ImageBladeRenderer;
use OllieCodes\Etched\Inline\Renderer\InlineHtmlBladeRenderer;
use OllieCodes\Etched\Inline\Renderer\LinkBladeRenderer;
use OllieCodes\Etched\Inline\Renderer\NewlineBladeRenderer;
use OllieCodes\Etched\Inline\Renderer\StrongBladeRenderer;
use OllieCodes\Etched\Inline\Renderer\TextBladeRenderer;

class EtchedRenderers
{
    public static function register(ConfigurableEnvironmentInterface $environment, array $extensions): void
    {
        // Block renderers
        $environment->addBlockRenderer(BlockQuote::class, new BlockQuoteBladeRenderer, 1)
                    ->addBlockRenderer(FencedCode::class, new FencedCodeBladeRenderer, 1)
                    ->addBlockRenderer(Heading::class, new HeadingBladeRenderer, 1)
                    ->addBlockRenderer(HtmlBlock::class, new HtmlBladeRenderer, 1)
                    ->addBlockRenderer(IndentedCode::class, new IndentedCodeBladeRenderer, 1)
                    ->addBlockRenderer(ListBlock::class, new ListBladeRenderer, 1)
                    ->addBlockRenderer(ListItem::class, new ListItemBladeRenderer, 1)
                    ->addBlockRenderer(Paragraph::class, new ParagraphBladeRenderer, 1)
                    ->addBlockRenderer(ThematicBreak::class, new ThematicBreakBladeRenderer, 1);

        // Inline renderers
        $environment->addInlineRenderer(Code::class, new CodeBladeRenderer, 1)
                    ->addInlineRenderer(Emphasis::class, new EmphasisBladeRenderer, 1)
                    ->addInlineRenderer(HtmlInline::class, new InlineHtmlBladeRenderer, 1)
                    ->addInlineRenderer(Image::class, new ImageBladeRenderer, 1)
                    ->addInlineRenderer(Link::class, new LinkBladeRenderer, 1)
                    ->addInlineRenderer(Newline::class, new NewlineBladeRenderer, 1)
                    ->addInlineRenderer(Strong::class, new StrongBladeRenderer, 1)
                    ->addInlineRenderer(Text::class, new TextBladeRenderer, 1);

        // Extension specific renderers
        // - dunno
    }
}