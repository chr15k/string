<?php

namespace ChrisTelKel\String\Test;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function test_autoloading()
    {
        $this->assertTrue(str_contains('ChrisTelKel', 'Chris'));
    }
}