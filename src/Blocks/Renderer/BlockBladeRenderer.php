<?php

namespace OllieCodes\Etched\Blocks\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class BlockBladeRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    /**
     * @var \League\CommonMark\Block\Renderer\BlockRendererInterface
     */
    private $parent;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $tagSuffix;

    public function __construct(BlockRendererInterface $parent, string $name, bool $tagSuffix = false)
    {
        $this->parent    = $parent;
        $this->name      = $name;
        $this->tagSuffix = $tagSuffix;
    }

    /**
     * @param Heading                  $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool                     $inTightList
     *
     * @return string
     */
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false): string
    {
        $element = $this->parent->render($block, $htmlRenderer, $inTightList);
        $name    = $this->name;

        if ($this->tagSuffix) {
            $name .= '.' . $element->getTagName();
        }

        return $this->getTheme()->block($name, [
            'attributes' => $element->getAllAttributes(),
            'content'    => $element->getContents(),
        ]);
    }
}