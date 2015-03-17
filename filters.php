<?php

if (!function_exists('parseMarkdown')) {
    function parseMarkdown($value)
    {
        $value = Markdown::parse($value);
        $value = Purifier::clean($value);

        return $value;
    }
}
