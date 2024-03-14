<?php

namespace Stepanenko3\NovaCards;

interface MarkdownConverter
{
    /**
     * Parse the given Markdown text into HTML.
     *
     * @param string $text
     *
     * @return \Illuminate\Support\HtmlString
     */
    public static function parse($text);
}
