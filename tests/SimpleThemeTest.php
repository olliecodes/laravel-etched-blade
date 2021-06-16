<?php

namespace OllieCodes\Etched\Tests;

use League\CommonMark\EnvironmentInterface;
use OllieCodes\Etched\Etched;

class SimpleThemeTest extends TestCase
{
    protected $theme = 'simple';

    /**
     * @test
     */
    public function rendersBlockBlockQuoteCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/block-quote');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockFencedCodeCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/fenced-code');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockFencedCodeWithLanguageCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/fenced-code-language');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockH1Correctly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/h1');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockH2Correctly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/h2');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockH3Correctly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/h3');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockH4Correctly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/h4');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockH5Correctly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/h5');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockH6Correctly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/h6');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockAllowedHtmlCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/html');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockEscapedHtmlCorrectly(): void
    {
        $this->app->make('config')->set('etched.defaults.options.config.html_input', EnvironmentInterface::HTML_INPUT_ESCAPE);

        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/html-escaped');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockStrippedHtmlCorrectly(): void
    {
        $this->app->make('config')->set('etched.defaults.options.config.html_input', EnvironmentInterface::HTML_INPUT_STRIP);

        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/html-stripped');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockIndentedCodeCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/indented-code');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockOrderedListCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/ordered-list');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockOrderedListWithNonOneStartCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/ordered-list-start');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockUnorderedListCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/unordered-list');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockUnorderedListWithinInlineContentCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/unordered-list-inline-content');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockParagraphCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/paragraph');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersBlockThematicBreakCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'blocks/thematic-break');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineCodeCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/code');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineEmphasisCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/emphasis');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineImageCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/image');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineAllowedHtmlCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/html');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineEscapedHtmlCorrectly(): void
    {
        $this->app->make('config')->set('etched.defaults.options.config.html_input', EnvironmentInterface::HTML_INPUT_ESCAPE);

        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/html-escaped');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineStrippeddHtmlCorrectly(): void
    {
        $this->app->make('config')->set('etched.defaults.options.config.html_input', EnvironmentInterface::HTML_INPUT_STRIP);

        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/html-stripped');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineLinkCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/link');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineStrongCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/strong');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }

    /**
     * @test
     */
    public function rendersInlineSoftNewlineCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/newline-softbreak');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }


    /**
     * @test
     */
    public function rendersInlineHardNewlineCorrectly(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = $this->themedContent($this->theme, 'inline/newline-hardbreak');

        self::assertSame($content['expected'], $etched->render($content['markdown'], $this->theme));
    }
}