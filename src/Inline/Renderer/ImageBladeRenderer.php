<?php

namespace OllieCodes\Etched\Inline\Renderer;

use InvalidArgumentException;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Image;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\RegexHelper;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class ImageBladeRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (! ($inline instanceof Image)) {
            // @codeCoverageIgnoreStart
            throw new InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
            // @codeCoverageIgnoreEnd
        }

        $attributes        = $inline->getData('attributes', []);
        $forbidUnsafeLinks = ! $this->config->get('allow_unsafe_links');

        if ($forbidUnsafeLinks && RegexHelper::isLinkPotentiallyUnsafe($inline->getUrl())) {
            $attributes['src'] = '';
        } else {
            $attributes['src'] = $inline->getUrl();
        }

        $alt               = $htmlRenderer->renderInlines($inline->children());
        $alt               = preg_replace('/\<[^>]*alt="([^"]*)"[^>]*\>/', '$1', $alt);
        $attributes['alt'] = preg_replace('/\<[^>]*\>/', '', $alt);

        if (isset($inline->data['title'])) {
            $attributes['title'] = $inline->data['title'];
        }

        return $this->getTheme()->inline('image', compact('attributes'));
    }
}