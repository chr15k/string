<?php 

require_once __DIR__ . '/../vendor/autoload.php';

echo \StringHelpers\Str::plural('bus') . PHP_EOL;
echo str_plural('bus') . PHP_EOL;
// output: buses

echo \StringHelpers\Str::singular('buses') . PHP_EOL;
echo str_singular('buses') . PHP_EOL;
// output: bus

echo \StringHelpers\Str::snake('Hello there') . PHP_EOL;
echo snake_case('Hello there') . PHP_EOL;
// output: hello_there

echo \StringHelpers\Str::camel('Hello there') . PHP_EOL;
echo camel_case('Hello there') . PHP_EOL;
// output: helloThere

echo \StringHelpers\Str::slug('we wish you a merry christmas') . PHP_EOL;
echo str_slug('we wish you a merry christmas') . PHP_EOL;
// output: we-wish-you-a-merry-christmas