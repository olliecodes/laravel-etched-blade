{{--

$frontMatter
============
Contains an array of key => value pairs provided by the frontmatter for the markdown file. Values can be most primitive
types, including string, boolean, int, float and array.

$attributes
===========
Contains an array containing HTML attributes provided by the Attribute extension for league/commonmark. If this
extension or no attributes are present, this will be an empty array.

$level
==========
The level of heading, ie; 1,2,3,4,5 or 6.

$content
========
Contains the content, can contain HTML.

--}}
<h{{ $level }}>{!! $content !!}</h{{ $level }}>