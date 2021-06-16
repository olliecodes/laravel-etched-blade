<?php

namespace OllieCodes\Etched\Blocks\Renderer;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\ListBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class ListBladeRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (! ($block instanceof ListBlock)) {
            // @codeCoverageIgnoreStart
            throw new InvalidArgumentException('Incompatible block type: ' . get_class($block));
            // @codeCoverageIgnoreEnd
        }

        $data       = $block->getListData();
        $type       = $data->type === ListBlock::TYPE_BULLET ? 'unordered' : 'ordered';
        $attributes = $block->getData('attributes', []);

        if ($data->start !== null && $data->start !== 1) {
            $attributes['start'] = (string)$data->start;
        }

        return $this->getTheme()->block('list.' . $type, [
            'attributes' => $attributes,
            'content'    => $htmlRenderer->renderBlocks($block->children(), $block->isTight()),
        ]);
    }
}