<?php

namespace OllieCodes\Etched\Blocks\Renderer;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\BlockQuote;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class BlockQuoteBladeRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (! ($block instanceof BlockQuote)) {
            // @codeCoverageIgnoreStart
            throw new InvalidArgumentException('Incompatible block type: ' . get_class($block));
            // @codeCoverageIgnoreEnd
        }

        return $this->getTheme()->block('blockquote', [
            'attributes' => $block->getData('attributes', []),
            'content'    => $htmlRenderer->renderBlocks($block->children()),
        ]);
    }
}