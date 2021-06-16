<?php

namespace OllieCodes\Etched\Blocks\Renderer;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Extension\TaskList\TaskListItemMarker;
use League\CommonMark\Util\ConfigurationAwareInterface;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class ListItemBladeRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (! ($block instanceof ListItem)) {
            // @codeCoverageIgnoreStart
            throw new InvalidArgumentException('Incompatible block type: ' . get_class($block));
            // @codeCoverageIgnoreEnd
        }

        $contents = $htmlRenderer->renderBlocks($block->children(), $inTightList);

        if (strpos($contents, '<') === 0 && ! $this->startsTaskListItem($block)) {
            $contents = "\n" . $contents;
        }

        if ($contents[strlen($contents) - 1] === '>') {
            $contents .= "\n";
        }

        return $this->getTheme()->block('list.item', [
            'attributes' => $block->getData('attributes', []),
            'content'    => $contents,
        ]);
    }

    private function startsTaskListItem(ListItem $block): bool
    {
        $firstChild = $block->firstChild();

        return $firstChild instanceof Paragraph && $firstChild->firstChild() instanceof TaskListItemMarker;
    }
}