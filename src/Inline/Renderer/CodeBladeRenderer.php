<?php

namespace OllieCodes\Etched\Inline\Renderer;

use InvalidArgumentException;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Code;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\Xml;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class CodeBladeRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (! ($inline instanceof Code)) {
            // @codeCoverageIgnoreStart
            throw new InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
            // @codeCoverageIgnoreEnd
        }

        return $this->getTheme()->inline('code', [
            'attributes' => $inline->getData('attributes', []),
            'content'    => Xml::escape($inline->getContent()),
        ]);
    }
}