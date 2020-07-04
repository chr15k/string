<?php

use StringHelpers\Str;

if (! function_exists('str_plural')) {

    function str_plural($value, $count = 2)
    {
        return Str::plural($value, $count);
    }
}

if (! function_exists('str_contains')) {

    function str_contains($haystack, $needles)
    {
        return Str::contains($haystack, $needles);
    }
}

if (! function_exists('str_singular')) {

    function str_singular($value)
    {
        return Str::singular($value);
    }
}

if (! function_exists('str_slug')) {

    function str_slug($title, $separator = '-', $language = 'en')
    {
        return Str::slug($title, $separator, $language);
    }
}

if (! function_exists('studly_case')) {

    function studly_case($value)
    {
        return Str::studly($value);
    }
}

if (! function_exists('camel_case')) {

    function camel_case($value)
    {
        return Str::camel($value);
    }
}

if (! function_exists('snake_case')) {

    function snake_case($value, $delimiter = '_')
    {
        return Str::snake($value, $delimiter);
    }
}