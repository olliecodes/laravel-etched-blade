<?php

return [
    'themes' => [
        'simple' => [
            'options' => [
                'view_path' => 'etched::themes.simple',
            ],
        ],

        'tailwind' => [
            'options' => [
                'view_path' => 'etched::themes.tailwind',
            ],
        ],
    ],

    'defaults' => [
        'theme' => 'simple',

        'options' => [
            'extensions' => [
                //League\CommonMark\Extension\Autolink\AutolinkExtension::class,
                League\CommonMark\Extension\ExternalLink\ExternalLinkExtension::class,
                //League\CommonMark\Extension\GithubFlavoredMarkdownExtension::class,
                //League\CommonMark\Extension\Footnote\FootnoteExtension::class,
                League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
                //League\CommonMark\Extension\TableOfContents\TableOfContentsExtension::class,
            ],

            'config' => [
                'html_input' => League\CommonMark\EnvironmentInterface::HTML_INPUT_ALLOW,

                /*
                 * Reference: https://commonmark.thephpleague.com/1.6/extensions/external-links
                 */
                'external_link'     => [
                    'internal_hosts'     => ['www.example.com'],
                    'open_in_new_window' => true,
                    'html_class'         => 'external-link',
                    'nofollow'           => '',
                    'noopener'           => 'external',
                    'noreferrer'         => 'external',
                ],

                /*
                 * Reference: https://commonmark.thephpleague.com/1.6/extensions/footnotes/
                 */
                'footnote'          => [
                    'backref_class'      => 'footnote-backref',
                    'container_add_hr'   => true,
                    'container_class'    => 'footnotes',
                    'ref_class'          => 'footnote-ref',
                    'ref_id_prefix'      => 'fnref:',
                    'footnote_class'     => 'footnote',
                    'footnote_id_prefix' => 'fn:',
                ],

                /*
                 * Reference: https://commonmark.thephpleague.com/1.6/extensions/heading-permalinks/
                 */
                'heading_permalink' => [
                    'html_class'      => 'heading-permalink',
                    'id_prefix'       => 'user-content',
                    'insert'          => 'before',
                    'title'           => 'Permalink',
                    'symbol'          => League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer::DEFAULT_SYMBOL,
                    'slug_normalizer' => new League\CommonMark\Normalizer\SlugNormalizer(),
                ],

                /*
                 * Reference: https://commonmark.thephpleague.com/1.6/extensions/table-of-contents/
                 */
                'table_of_contents' => [
                    'html_class'        => 'table-of-contents',
                    'position'          => 'top',
                    'style'             => 'bullet',
                    'min_heading_level' => 1,
                    'max_heading_level' => 6,
                    'normalize'         => 'relative',
                    'placeholder'       => null,
                ],
            ],
        ],

        'block' => [
            'heading'        => 'blocks.heading',
            'blockquote'     => 'blocks.blockquote',
            'code-fenced'    => 'blocks.code-fenced',
            'code-indented'  => 'blocks.code-indented',
            'html'           => 'blocks.html',
            'list'           => [
                'ordered'   => 'blocks.list-ordered',
                'unordered' => 'blocks.list-unordered',
                'item'      => 'blocks.list-item',
            ],
            'paragraph'      => 'blocks.paragraph',
            'thematic-break' => 'blocks.thematic-break',
        ],

        'inline' => [
            'code'     => 'inline.code',
            'emphasis' => 'inline.emphasis',
            'html'     => 'inline.html',
            'image'    => 'inline.image',
            'link'     => 'inline.link',
            'newline'  => 'inline.newline',
            'strong'   => 'inline.strong',
            'text'     => 'inline.text',
        ],
    ],
];