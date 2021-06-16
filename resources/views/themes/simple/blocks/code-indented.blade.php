{{--

$frontMatter
============
Contains an array of key => value pairs provided by the frontmatter for the markdown file. Values can be most primitive
types, including string, boolean, int, float and array.

$attributes
===========
Contains an array containing HTML attributes provided by the Attribute extension for league/commonmark. If this
extension or no attributes are present, this will be an empty array.

$content
========
Contains the content, will not contain HTML.

--}}
<pre><code>{!! $content !!}</code></pre>