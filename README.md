# String helpers

## Install
```sh
composer install
```

## Usage

```php
echo \StringHelpers\Str::plural('bus');
// output: buses

echo \StringHelpers\Str::singular('buses');
// output: bus

echo \StringHelpers\Str::snake('Hello there');
// output: hello_there

echo \StringHelpers\Str::camel('Hello there');
// output: helloThere

echo \StringHelpers\Str::slug('we wish you a merry christmas');
// output: we-wish-you-a-merry-christmas
```