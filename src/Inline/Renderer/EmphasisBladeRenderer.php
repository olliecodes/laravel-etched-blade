<?php

namespace OllieCodes\Etched\Inline\Renderer;

use InvalidArgumentException;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Emphasis;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class EmphasisBladeRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (! ($inline instanceof Emphasis)) {
            // @codeCoverageIgnoreStart
            throw new InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
            // @codeCoverageIgnoreEnd
        }

        return $this->getTheme()->inline('code', [
            'attributes' => $inline->getData('attributes', []),
            'content'    => $htmlRenderer->renderInlines($inline->children()),
        ]);
    }
}