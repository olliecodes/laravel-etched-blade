<?php

namespace OllieCodes\Etched;

use Illuminate\Config\Repository;
use Illuminate\Contracts\View\Factory;
use InvalidArgumentException;
use League\CommonMark\Environment;
use League\CommonMark\Event\DocumentPreParsedEvent;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\MarkdownConverterInterface;

class Theme
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \Illuminate\Config\Repository
     */
    private $config;

    /**
     * @var \Illuminate\Contracts\View\Factory
     */
    private $viewFactory;

    /**
     * @var \League\CommonMark\MarkdownConverterInterface
     */
    private $markdownConverter;

    /**
     * @var array<array>
     */
    private $frontMatterData = [];

    public function __construct(string $name, array $config, Factory $viewFactory)
    {
        $this->name        = $name;
        $this->config      = new Repository($config);
        $this->viewFactory = $viewFactory;
    }

    public function block(string $name, array $data): string
    {
        return $this->render('block', $name, $data);
    }

    protected function config(string $key, $default = null)
    {
        return $this->config->get($key, $default);
    }

    private function createMarkdownConverter(): void
    {
        // Is this GitHub flavoured markdown?
        $gfm = $this->config('options.gfm', false);
        // Create the environment
        $environment = $gfm ? Environment::createCommonMarkEnvironment() : Environment::createGFMEnvironment();
        // Get the extensions this theme uses
        $extensions = $this->config('options.extensions');
        // Get the commonmark configuration for this theme
        $config = $this->config('options.config');

        // Loop through the extensions and register them
        foreach ($extensions as $extension) {
            $environment->addExtension(new $extension);
        }

        // Set the current theme on the config
        $config['theme'] = $this;

        // Merge the configuration in
        $environment->mergeConfig($config);

        // Add an event listener so the front matter data is present
        $environment->addEventListener(DocumentPreParsedEvent::class, [$this, 'setLatestFrontMatterData']);

        // Register the custom renders from Etched, so the functionality actually works
        EtchedRenderers::register($environment, $extensions);

        // Create the converter
        $this->markdownConverter = $gfm ? new GithubFlavoredMarkdownConverter([], $environment) : new MarkdownConverter($environment);
    }

    protected function getLatestFrontMatterData(): array
    {
        return array_pop($this->frontMatterData) ?? [];
    }

    /**
     * @return \League\CommonMark\MarkdownConverterInterface
     */
    public function getMarkdownConverter(): MarkdownConverterInterface
    {
        if ($this->markdownConverter === null) {
            $this->createMarkdownConverter();
        }

        return $this->markdownConverter;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory
     */
    public function getViewFactory(): Factory
    {
        return $this->viewFactory;
    }

    public function inline(string $name, array $data): string
    {
        return $this->render('inline', $name, $data);
    }

    public function parse(string $content, array $data = []): string
    {
        $this->frontMatterData[] = $data;

        return $this->getMarkdownConverter()->convertToHtml($content);
    }

    public function render(string $type, string $name, array $data): string
    {
        $viewPath = $this->config('options.view_path');

        if (! $viewPath) {
            throw new InvalidArgumentException(sprintf('Theme \'%s\' is missing its \'options.view_path\' configuration', $this->getName()));
        }

        $subViewPath = $this->config($type . '.' . $name);

        if (! $subViewPath) {
            throw new InvalidArgumentException(sprintf('Theme \'%s\' is missing its \'%s\' configuration', $this->getName(), $type . '.' . $name));
        }

        $data['frontMatter'] = $this->frontMatterData;

        return $this->getViewFactory()->make($viewPath . '.' . $subViewPath, $data)->render();
    }

    public function setLatestFrontMatterData(DocumentPreParsedEvent $event): void
    {
        $event->getDocument()->data = array_merge_recursive($event->getDocument()->data, $this->getLatestFrontMatterData());
    }
}