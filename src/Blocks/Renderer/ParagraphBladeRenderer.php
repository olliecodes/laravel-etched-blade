<?php

namespace OllieCodes\Etched\Blocks\Renderer;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class ParagraphBladeRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (! ($block instanceof Paragraph)) {
            throw new InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        if ($inTightList) {
            return $htmlRenderer->renderInlines($block->children());
        }

        return $this->getTheme()->block('paragraph', [
            'attributes' => $block->getData('attributes', []),
            'content'    => $htmlRenderer->renderInlines($block->children()),
        ]);
    }
}