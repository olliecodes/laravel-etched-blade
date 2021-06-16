{{--

$frontMatter
============
Contains an array of key => value pairs provided by the frontmatter for the markdown file. Values can be most primitive
types, including string, boolean, int, float and array.

$attributes
===========
Contains an array containing HTML attributes provided by the Attribute extension for league/commonmark. If this
extension or no attributes are present, this will be an empty array.

$languages
==========
Contains an array of languages, if provided in the original markdown.

$content
========
Contains the content, will not contain HTML.

--}}
<pre><code @if(!empty($languages))class="{{ implode(' ', array_map(static function(string $language) { return 'language-'.$language; }, $languages)) }}"@endif>{{ $content }}</code></pre>