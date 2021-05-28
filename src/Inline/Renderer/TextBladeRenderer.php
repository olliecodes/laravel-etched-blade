<?php

namespace OllieCodes\Etched\Inline\Renderer;

use InvalidArgumentException;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Text;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\Xml;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class TextBladeRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (! ($inline instanceof Text)) {
            throw new InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        return $this->getTheme()->inline('text', [
            'content' => Xml::escape($inline->getContent()),
        ]);
    }
}