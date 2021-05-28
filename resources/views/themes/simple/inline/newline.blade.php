{{--

$frontMatter
============
Contains an array of key => value pairs provided by the frontmatter for the markdown file. Values can be most primitive
types, including string, boolean, int, float and array.

$type
===========
The type of break. Will be 0 for a hardbreak (br) or 1 for a soft break (\n)

--}}

@if ($type === \League\CommonMark\Inline\Element\Newline::HARDBREAK)
    <br/>

@else

@endif