<?php

use Chr15k\String\Stringable;

if (! function_exists('s')) {
    /**
     * @param string $string
     * @return Stringable
     */
    function s($string = '')
    {
        return new Stringable($string);
    }
}
