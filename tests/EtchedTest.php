<?php

namespace OllieCodes\Etched\Tests;

class EtchedTest extends TestCase
{
    /**
     * @test
     */
    public function bladeDirectiveWorksCorrectly(): void
    {
        $renderedContent = view('fixtures::directive')->render();
        $content         = $this->content('directive.blade.html');

        self::assertSame($content, $renderedContent);
    }

    /**
     * @test
     */
    public function viewEngineUsesEtchedToRenderMarkdown(): void
    {
        $renderedContent = view('fixtures::blade-and-markdown')->render();
        $content         = $this->content('blade-and-markdown.blade.html');

        self::assertSame($content, $renderedContent);
    }
}