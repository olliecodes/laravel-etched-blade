<?php

namespace OllieCodes\Etched\Inline\Renderer;

use InvalidArgumentException;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\EnvironmentInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\HtmlInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class InlineHtmlBladeRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (! ($inline instanceof HtmlInline)) {
            throw new InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        if ($this->config->get('html_input') === EnvironmentInterface::HTML_INPUT_STRIP) {
            return '';
        }

        if ($this->config->get('html_input') === EnvironmentInterface::HTML_INPUT_ESCAPE) {
            return htmlspecialchars($inline->getContent(), ENT_NOQUOTES);
        }

        return $this->getTheme()->inline('html', ['content' => $inline->getContent()]);
    }
}