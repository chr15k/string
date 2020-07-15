# String helpers for your PHP project

[![Latest Stable Version](https://poser.pugx.org/chr15k/string/v)](//packagist.org/packages/chr15k/string) [![Latest Unstable Version](https://poser.pugx.org/chr15k/string/v/unstable)](//packagist.org/packages/chr15k/string) [![Total Downloads](https://poser.pugx.org/chr15k/string/downloads)](//packagist.org/packages/chr15k/string) [![License](https://poser.pugx.org/chr15k/string/license)](//packagist.org/packages/chr15k/string)

This package provides useful helpers for working with strings in PHP, including UUID and ASCII support.

This library has 3 dependencies:

- [doctrine/inflector](https://github.com/doctrine/inflector) (Plural/Singular word support)
- [ramsey/uuid](https://github.com/ramsey/uuid) (UUID generation support)
- [voku/portable-ascii](https://github.com/voku/portable-ascii) (ASCII support)

Based on ...

- Laravel's string helper work (https://github.com/laravel/framework)

## Install
You can install this package via composer:

```bash
composer require chr15k/string
```

## Usage
<details>
  <summary>String Methods</summary>

- [after](#after)
- [afterLast](#afterLast)
- [before](#before)
- [camel](#camel)
- [contains](#contains)
- [containsAll](#containsAll)
- [endsWith](#endsWith)
- [finish](#finish)
- [isAscii](#isAscii)
- [isUuid](#isUuid)
- [kebab](#kebab)
- [length](#length)
- [limit](#limit)
- [lower](#lower)
- [match](#match)
- [orderedUuid](#orderedUuid)
- [plural](#plural)
- [possessive](#possessive)
- [random](#random)
- [replaceArray](#replaceArray)
- [replaceFirst](#replaceFirst)
- [replaceLast](#replaceLast)
- [singular](#singular)
- [slug](#slug)
- [snake](#snake)
- [start](#start)
- [startsWith](#startsWith)
- [studly](#studly)
- [title](#title)
- [ucfirst](#ucfirst)
- [upper](#upper)
- [uuid](#uuid)
- [words](#words)

### <a id="after"></a>Str::after()
```php
$slice = Str::after('This is my name', 'This is');

// ' my name'
```

### <a id="afterLast"></a>Str::afterLast()
```php
$slice = Str::afterLast('App\Controllers\Controller', '\\');

// 'Controller'
```

### <a id="before"></a>Str::before()
```php
$slice = Str::before('This is my name', 'my name');

// 'This is '
```

### <a id="camel"></a>Str::camel()
```php
$converted = Str::camel('foo_bar')

// fooBar
```

### <a id="contains"></a>Str::contains()
```php
$contains = Str::contains('This is my name', 'my');

// true
```

### <a id="containsAll"></a>Str::containsAll()
```php
$containsAll = Str::containsAll('This is my name', ['my', 'name']);

// true
```

### <a id="endsWith"></a>Str::endsWith()
```php
$result = Str::endsWith('This is my name', 'name');

// true
```

### <a id="finish"></a>Str::finish()
```php
$adjusted = Str::finish('this/string', '/');

// this/string/

$adjusted = Str::finish('this/string/', '/');

// this/string/
```

### <a id="isAscii"></a>Str::isAscii()
```php
$isAscii = Str::isAscii('Chris');

// true

$isAscii = Str::isAscii('ü');

// false
```

### <a id="isUuid"></a>Str::isUuid()
```php
$isUuid = Str::isUuid('a0a2a2d2-0b87-4a18-83f2-2529882be2de');

// true

$isUuid = Str::isUuid('chris');

// false
```

### <a id="kebab"></a>Str::kebab()
```php
$converted = Str::kebab('fooBar');

// foo-bar
```

### <a id="length"></a>Str::length()
```php
$length = Str::length('Chris');

// 5
```

### <a id="limit"></a>Str::limit()
```php
$truncated = Str::limit('The quick brown fox jumps over the lazy dog', 20);

// The quick brown fox...
```

### <a id="lower"></a>Str::lower()
```php
$lower = Str::lower('CHRIS');

// chris
```

### <a id="match"></a>Str::match()
```php
$matches = Str::match('foo*', 'foobar');

// true

$matches = Str::match('baz*', 'foobar');

// false
```

### <a id="orderedUuid"></a>Str::orderedUuid()
The Str::orderedUuid() method generates a "timestamp first" UUID that may be efficiently stored in an indexed database column.
```php
$orderedUuid = Str::orderedUuid();

// 90f81d6c-b4f6-4b03-a82d-800058a21705
```

### <a id="plural"></a>Str::plural()
```php
$plural = Str::plural('bus');

// buses

$plural = Str::plural('child');

// children


// Pass second argument to retrieve the singular or plural form of the string...

$plural = Str::plural('child', 2);

// children

$plural = Str::plural('child', 1);

// child
```

### <a id="possessive"></a>Str::possessive()
```php
$possessive = Str::possessive('Chris');

// Chris'

$possessive = Str::possessive('David');

// David's

$possessive = Str::possessive('it');

// its
```

### <a id="random"></a>Str::random()
```php
$random = Str::random(40);

// odkX5tWGo3tb8hlNgdoVPjHxZR8xRzii1uFT1cxa
```

### <a id="replaceArray"></a>Str::replaceArray()
```php
$string = 'The event will take place between ? and ?';

$replaced = Str::replaceArray('?', ['8:30', '9:00'], $string);

// The event will take place between 8:30 and 9:00
```

### <a id="replaceFirst"></a>Str::replaceFirst()
```php
$replaced = Str::replaceFirst('the', 'a', 'the quick brown fox jumps over the lazy dog');

// a quick brown fox jumps over the lazy dog
```

### <a id="replaceLast"></a>Str::replaceLast()
```php
$replaced = Str::replaceLast('the', 'a', 'the quick brown fox jumps over the lazy dog');

// the quick brown fox jumps over a lazy dog
```

### <a id="singular"></a>Str::singular()
```php
$singular = Str::singular('cars');

// car

$singular = Str::singular('children');

// child
```

### <a id="slug"></a>Str::slug()
```php
$slug = Str::slug('Chris The Coder', '-');

// chris-the-coder
```

### <a id="snake"></a>Str::snake()
```php
$converted = Str::snake('fooBar');

// foo_bar
```

### <a id="start"></a>Str::start()
```php
$adjusted = Str::start('this/string', '/');

// /this/string

$adjusted = Str::start('/this/string', '/');

// /this/string
```

### <a id="startsWith"></a>Str::startsWith()
```php
$result = Str::startsWith('This is my name', 'This');

// true
```

### <a id="studly"></a>Str::studly()
```php
$converted = Str::studly('foo_bar');

// FooBar
```

### <a id="title"></a>Str::title()
```php
$converted = Str::title('a nice title uses the correct case');

// A Nice Title Uses The Correct Case
```

### <a id="ucfirst"></a>Str::ucfirst()
```php
$string = Str::ucfirst('foo bar');

// Foo bar
```

### <a id="upper"></a>Str::upper()
```php
$string = Str::upper('chris');

// CHRIS
```

### <a id="uuid"></a>Str::uuid()
```php
$uuid = Str::uuid();

// 0b1a9d6f-e2c7-489d-93f9-331108ebc314
```

### <a id="words"></a>Str::words()
```php
return Str::words('Perfectly balanced, as all things should be.', 3, ' >>>');

// Perfectly balanced, as >>>
```
</details>

<details>
  <summary>String Method Chaining</summary>

<p>You can also chain multiple string operations together using the `s()` helper.</p>

- [after](#after2)
- [afterLast](#afterLast2)
- [append](#append2)
- [ascii](#ascii2)
- [basename](#basename2)
- [before](#before2)
- [beforeLast](#beforeLast2)
- [camel](#camel2)
- [contains](#contains2)
- [containsAll](#containsAll2)
- [dirname](#dirname2)
- [endsWith](#endsWith2)
- [exactly](#exactly2)
- [explode](#explode2)
- [finish](#finish2)
- [isAscii](#isAscii2)
- [isEmpty](#isEmpty2)
- [isNotEmpty](#isNotEmpty2)
- [kebab](#kebab2)
- [length](#length2)
- [limit](#limit2)
- [lower](#lower2)
- [ltrim](#ltrim2)
- [match](#match2)
- [plural](#plural2)
- [possessive](#possessive2)
- [prepend](#prepend2)
- [replace](#replace2)
- [replaceArray](#replaceArray2)
- [replaceFirst](#replaceFirst2)
- [replaceLast](#replaceLast2)
- [rtrim](#rtrim2)
- [singular](#singular2)
- [slug](#slug2)
- [snake](#snake2)
- [split](#split2)
- [start](#start2)
- [startsWith](#startsWith2)
- [studly](#studly2)
- [substr](#substr2)
- [title](#title2)
- [trim](#trim2)
- [ucfirst](#ucfirst2)
- [upper](#upper2)
- [whenEmpty](#whenEmpty2)
- [words](#words2)

### <a id="after2"></a>after
```php
$slice = s('This is my name')->after('This is');

// ' my name'
```

### <a id="afterLast2"></a>afterLast
```php
$slice = s('App\Controllers\Controller')->afterLast('\\');

// 'Controller'
```

### <a id="append2"></a>append
```php
$string = s('Hello')->append(' there!');

// 'Hello there!'
```

### <a id="ascii2"></a>ascii
Transliterate the string to an ASCII value:
```php
$string = s('ü')->ascii();

// 'u'
```

### <a id="basename2"></a>basename
```php
$string = s('/foo/bar/baz')->basename();

// 'baz'

// If needed, you may provide an "extension" that will be removed from the trailing component:
$string = s('/foo/bar/baz.jpg')->basename('.jpg');

// 'baz'
```

### <a id="before2"></a>before
```php
$slice = s('This is my name')->before('my name');

// 'This is '
```

### <a id="beforeLast2"></a>beforeLast
```php
$slice = s('This is my name')->beforeLast('is');

// 'This '
```

### <a id="camel2"></a>camel
```php
$converted = s('foo_bar')->camel();

// fooBar
```

### <a id="contains2"></a>contains
```php
$contains = s('This is my name')->contains('my');

// true

// You can also pass an array:
$contains = s('This is my name')->contains(['my', 'foo']);

// true
```

### <a id="containsAll2"></a>containsAll
```php
$containsAll = s('This is my name')->containsAll(['my', 'name']);

// true
```

### <a id="dirname2"></a>dirname
```php
$string = s('/foo/bar/baz')->dirname();

// '/foo/bar'

// Optionally pass directory levels as second argument:
$string = s('/foo/bar/baz')->dirname(2);

// '/foo'
```

### <a id="endsWith2"></a>endsWith
```php
$result = s('This is my name')->endsWith('name');

// true

// You can also pass an array
$result = s('This is my name')->endsWith(['name', 'foo']);

// true

$result = s('This is my name')->endsWith(['this', 'foo']);

// false
```

### <a id="exactly2"></a>exactly
```php
$result = s('Chris')->exactly('Chris');

// true

$result = s(' Chris')->exactly('Chris');

// false

$result = s('Chris')->exactly('chris');

// false
```

### <a id="explode2"></a>explode
```php
$collection = s('foo bar baz')->explode(' ');

// ['foo', 'bar', 'baz']
```

### <a id="finish2"></a>finish
```php
$adjusted = s('this/string')->finish('/');

// this/string/

$adjusted = s('this/string/')->finish('/');

// this/string/
```

### <a id="isAscii2"></a>isAscii
```php
$result = s('Chris')->isAscii();

// true

$result = s('ü')->isAscii();

// false
```

### <a id="isEmpty2"></a>isEmpty
```php
$result = s('  ')->trim()->isEmpty();

// true

$result = s('Chris')->trim()->isEmpty();

// false
```

### <a id="isNotEmpty2"></a>isNotEmpty
```php
$result = s('  ')->trim()->isNotEmpty();

// false

$result = s('Chris')->trim()->isNotEmpty();

// true
```

### <a id="kebab2"></a>kebab
```php
$converted = s('fooBar')->kebab();

// foo-bar
```

### <a id="length2"></a>length
```php
$length = s('Chris')->length();

// 5
```

### <a id="limit2"></a>limit
```php
$truncated = s('The quick brown fox jumps over the lazy dog')->limit(20);

// The quick brown fox...

// pass second argument to append something other than '...'
$truncated = s('The quick brown fox jumps over the lazy dog')->limit(20, ' (...)');

// The quick brown fox (...)
```

### <a id="lower2"></a>lower
```php
$result = s('CHRIS')->lower();

// 'chris'
```

### <a id="ltrim2"></a>ltrim
```php
$string = s('  Chris  ')->ltrim();

// 'Chris  '

$string = s('/Chris/')->ltrim('/');

// 'Chris/'
```

### <a id="match2"></a>match
```php
$result = s('foo bar')->match('/bar/');

// 'bar'

$result = s('foo bar')->match('/foo (.*)/');

// 'bar'
```

### <a id="plural2"></a>plural
```php
$plural = s('car')->plural();

// cars

$plural = s('child')->plural();

// children

// Pass second argument as a count to determine singular or plural form of a string:
$plural = s('child')->plural(2);

// children

$plural = s('child')->plural(1);

// child
```

### <a id="possessive2"></a>possessive
```php
$possessive = s('Chris')->possessive();

// Chris'

$possessive = s('David')->possessive();

// David's

$possessive = s('it')->possessive();

// its
```

### <a id="prepend2"></a>prepend
```php
$string = s('World')->prepend('Hello ');

// Hello World
```

### <a id="replace2"></a>replace
```php
$replaced = s('Hello World')->replace('World', 'Chris');

// Hello Chris
```

### <a id="replaceArray2"></a>replaceArray
```php
$string = 'The event will take place between ? and ?';

$replaced = s($string)->replaceArray('?', ['8:30', '9:00']);

// The event will take place between 8:30 and 9:00
```

### <a id="replaceFirst2"></a>replaceFirst
```php
$replaced = s('the quick brown fox jumps over the lazy dog')->replaceFirst('the', 'a');

// a quick brown fox jumps over the lazy dog
```

### <a id="replaceLast2"></a>replaceLast
```php
$replaced = s('the quick brown fox jumps over the lazy dog')->replaceLast('the', 'a');

// the quick brown fox jumps over a lazy dog
```

### <a id="rtrim2"></a>rtrim
```php
$string = s('  Chris  ')->rtrim();

// '  Chris'

$string = s('/Chris/')->rtrim('/');

// '/Chris'
```

### <a id="singular2"></a>singular
```php
$singular = s('cars')->singular();

// car

$singular = s('children')->singular();

// child
```

### <a id="slug2"></a>slug
```php
$slug = s('Hello World')->slug('-');

// hello-world
```

### <a id="snake2"></a>snake
```php
$converted = s('fooBar')->snake();

// foo_bar
```

### <a id="split2"></a>split
```php
$segments = s('one, two, three')->split('/[\s,]+/');

// collect(["one", "two", "three"])
```

### <a id="start2"></a>start
```php
$adjusted = s('this/string')->start('/');

// /this/string

$adjusted = s('/this/string')->start('/');

// /this/string
```

### <a id="startsWith2"></a>startsWith
```php
$result = s('This is my name')->startsWith('This');

// true
```

### <a id="studly2"></a>studly
```php
$converted = s('foo_bar')->studly();

// FooBar
```

### <a id="substr2"></a>substr
```php
$string = s('Hello World')->substr(6);

// World

$string = s('Hello World')->substr(6, 3);

// Wo
```

### <a id="title2"></a>title
```php
$converted = s('a nice title uses the correct case')->title();

// A Nice Title Uses The Correct Case
```

### <a id="trim2"></a>trim
```php
$string = s('  Chris  ')->trim();

// 'Chris'

$string = s('/Chris/')->trim('/');

// 'Chris'
```

### <a id="ucfirst2"></a>ucfirst
```php
$string = s('foo bar')->ucfirst();

// Foo bar
```

### <a id="upper2"></a>upper
```php
$adjusted = s('chris')->upper();

// CHRIS
```

### <a id="whenEmpty2"></a>whenEmpty
The whenEmpty method invokes the given Closure if the string is empty:
```php
$string = s('  ')->whenEmpty(function ($string) {
    return $string->trim()->prepend('Chris');
});

// 'Chris'
```

### <a id="words2"></a>words
```php
$string = s('Perfectly balanced, as all things should be.')->words(3, ' >>>');

// Perfectly balanced, as >>>
```
</details>

## Testing
You can run the tests with:

```
vendor/bin/phpunit
```

## License
The MIT License (MIT). Please see [License File](https://github.com/chr15k/string/blob/master/LICENSE.md) for more information.