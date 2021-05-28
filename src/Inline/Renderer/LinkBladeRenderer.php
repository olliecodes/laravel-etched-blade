<?php

namespace OllieCodes\Etched\Inline\Renderer;

use InvalidArgumentException;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\RegexHelper;
use OllieCodes\Etched\Concerns\CommonmarkConfigurationAware;

class LinkBladeRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    use CommonmarkConfigurationAware;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (! ($inline instanceof Link)) {
            throw new InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        $attributes        = $inline->getData('attributes', []);
        $forbidUnsafeLinks = ! $this->config->get('allow_unsafe_links');

        if (! ($forbidUnsafeLinks && RegexHelper::isLinkPotentiallyUnsafe($inline->getUrl()))) {
            $attributes['href'] = $inline->getUrl();
        }

        if (isset($inline->data['title'])) {
            $attributes['title'] = $inline->data['title'];
        }

        if (isset($attributes['target']) && $attributes['target'] === '_blank' && ! isset($attributes['rel'])) {
            $attributes['rel'] = 'noopener noreferrer';
        }

        return $this->getTheme()->inline('link', [
            'attributes' => $attributes,
            'content'    => $htmlRenderer->renderInlines($inline->children()),
        ]);
    }
}