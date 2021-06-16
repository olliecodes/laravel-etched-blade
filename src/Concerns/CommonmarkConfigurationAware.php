<?php

namespace OllieCodes\Etched\Concerns;

use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\ConfigurationInterface;
use OllieCodes\Etched\Theme;
use RuntimeException;

trait CommonmarkConfigurationAware
{
    /**
     * @var ConfigurationInterface
     */
    protected $config;

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }

    protected function getTheme(): Theme
    {
        $theme = $this->config->get('theme');

        if ($theme === null) {
            throw new RuntimeException('No theme present for markdown conversion');
        }

        return $theme;
    }
}