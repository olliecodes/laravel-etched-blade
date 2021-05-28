<?php

namespace OllieCodes\Etched\Blocks\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\Xml;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class IndentedCodeBladeRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (! ($block instanceof IndentedCode)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . \get_class($block));
        }

        return $this->getTheme()->block('code-indented', [
            'attributes' => $block->getData('attributes', []),
            'content'    => Xml::escape($block->getStringContent()),
        ]);
    }
}