<?php

namespace OllieCodes\Etched\Tests\Fixtures;

trait LoadsContentForTests
{
    protected function themedContent(string $theme, string $name): array
    {
        return [
            'markdown' => $this->content($theme . DIRECTORY_SEPARATOR . $name . '.md'),
            'expected' => $this->content($theme . DIRECTORY_SEPARATOR . $name . '.html'),
        ];
    }

    protected function content(string $name): ?string
    {
        return @file_get_contents(__DIR__ . '/content/' . $name);
    }
}