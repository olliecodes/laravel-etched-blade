<?php

namespace OllieCodes\Etched\Blocks\Renderer;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\Xml;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class FencedCodeBladeRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (! ($block instanceof FencedCode)) {
            throw new InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        return $this->getTheme()->block('code-fenced', [
            'attributes' => $block->getData('attributes', []),
            'languages'  => $block->getInfoWords(),
            'content'    => Xml::escape($block->getStringContent()),
        ]);
    }
}