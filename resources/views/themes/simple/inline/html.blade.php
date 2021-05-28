{{--

$frontMatter
============
Contains an array of key => value pairs provided by the frontmatter for the markdown file. Values can be most primitive
types, including string, boolean, int, float and array.

$content
========
Contains HTML, escaped HTML or an empty string, dependant on the 'html_input' config option.

--}}
{!! $content !!}