<?php

namespace OllieCodes\Etched\Blocks\Renderer;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class InlineBladeRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    /**
     * @var \League\CommonMark\Inline\Renderer\InlineRendererInterface
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

    public function __construct(InlineRendererInterface $parent, string $name, bool $tagSuffix = false)
    {
        $this->parent    = $parent;
        $this->name      = $name;
        $this->tagSuffix = $tagSuffix;
    }

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        $element = $this->parent->render($inline, $htmlRenderer);
        $name    = $this->name;

        if ($this->tagSuffix) {
            $name .= '.' . $element->getTagName();
        }

        return $this->getTheme()->inline($name, [
            'attributes' => $element->getAllAttributes(),
            'content'    => $element->getContents(),
        ]);
    }
}