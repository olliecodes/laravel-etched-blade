<?php

namespace OllieCodes\Etched;

use Illuminate\Config\Repository;
use Illuminate\Contracts\View\Factory;
use InvalidArgumentException;
use Webuni\FrontMatter\FrontMatter;

class Etched
{
    /**
     * @var \Illuminate\Config\Repository
     */
    private $config;

    /**
     * @var array<string, Theme>
     */
    private $themes = [];

    /**
     * @var \Illuminate\Contracts\View\Factory
     */
    private $viewFactory;

    /**
     * @var \Webuni\FrontMatter\FrontMatter
     */
    private $frontMatterParser;

    public function __construct(array $config, Factory $viewFactory, ?FrontMatter $frontMatterParser = null)
    {
        $this->config            = new Repository($config);
        $this->viewFactory       = $viewFactory;
        $this->frontMatterParser = $frontMatterParser;
    }

    protected function config(string $key, $default = null)
    {
        return $this->config->get($key, $default);
    }

    private function createTheme(string $name): Theme
    {
        $config = $this->config('themes.' . $name);

        if ($config === null) {
            throw new InvalidArgumentException(sprintf('No theme found for \'%s\'', $name));
        }

        if (empty($config)) {
            throw new InvalidArgumentException(sprintf('Empty theme configuration for \'%s\'', $name));
        }

        $mergedConfig = [
            'options' => array_merge($this->config('defaults.options', []), $config['options']),
            'block'   => array_merge_recursive($this->config('defaults.block', []), $config['block'] ?? []),
            'inline'  => array_merge_recursive($this->config('defaults.inline', []), $config['inline'] ?? []),
        ];

        return $this->themes[$name] = new Theme($name, $mergedConfig, $this->viewFactory);
    }

    private function getDefaultThemeName(): string
    {
        return $this->config('defaults.theme', 'simple');
    }

    public function getFrontMatterParser(): FrontMatter
    {
        if (! $this->frontMatterParser) {
            $this->frontMatterParser = new FrontMatter;
        }

        return $this->frontMatterParser;
    }

    public function render(string $content, ?string $themeName = null): string
    {
        $frontMatterParser              = $this->getFrontMatterParser();
        $frontMatter = [];

        if ($frontMatterParser->exists($content)) {
            $document                       = $frontMatterParser->parse($content);
            $frontMatter                    = $document->getData();
            $content                        = $document->getContent();
            $themeName                      = $frontMatter['theme'];
        }

        return $this->theme($themeName)->parse($content, $frontMatter);
    }

    public function theme(?string $name = null): Theme
    {
        $name = $name ?? $this->getDefaultThemeName();

        return $this->themes[$name] ?? $this->createTheme($name);
    }
}