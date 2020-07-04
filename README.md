# String helpers

## Usage

`str_after()`
```php
$slice = str_after('This is my name', 'This is');

// ' my name'
```

`str_after_last()`
```php
$slice = str_after_last('App\Controllers\Controller', '\\');

// 'Controller'
```

`str_before()`
```php
$slice = str_before('This is my name', 'my name');

// 'This is '
```

`str_camel()`
```php
$converted = str_camel('foo_bar')

// fooBar
```

`str_contains()`
```php
$contains = str_contains('This is my name', 'my');

// true
```

`str_contains_all()`
```php
$containsAll = str_contains_all('This is my name', ['my', 'name']);

// true
```

`str_ends_with()`
```php
$result = str_ends_with('This is my name', 'name');

// true
```

`str_finish()`
```php
$adjusted = str_finish('this/string', '/');

// this/string/

$adjusted = str_finish('this/string/', '/');

// this/string/
```

`str_is_ascii()`
```php
$isAscii = str_is_ascii('Chris');

// true

$isAscii = str_is_ascii('ü');

// false
```

`str_is_uuid()`
```php
$isUuid = str_is_uuid('a0a2a2d2-0b87-4a18-83f2-2529882be2de');

// true

$isUuid = str_is_uuid('chris');

// false
```

`str_kebab()`
```php
$converted = str_kebab('fooBar');

// foo-bar
```

`str_length()`
```php
$length = str_length('Chris');

// 5
```

`str_limit()`
```php
$truncated = str_limit('The quick brown fox jumps over the lazy dog', 20);

// The quick brown fox...
```

`str_match()`
```php
$matches = str_match('foo*', 'foobar');

// true

$matches = str_match('baz*', 'foobar');

// false
```

`str_plural()`
```php
$plural = str_plural('bus');

// buses

$plural = str_plural('child');

// children


// Pass second argument to retrieve the singular or plural form of the string...

$plural = str_plural('child', 2);

// children

$plural = str_plural('child', 1);

// child
```

`str_random()`
```php
$random = str_random(40);

// odkX5tWGo3tb8hlNgdoVPjHxZR8xRzii1uFT1cxa
```

`str_replace_array()`
```php
$string = 'The event will take place between ? and ?';

$replaced = str_replace_array('?', ['8:30', '9:00'], $string);

// The event will take place between 8:30 and 9:00
```

`str_replace_first()`
```php
$replaced = str_replace_first('the', 'a', 'the quick brown fox jumps over the lazy dog');

// a quick brown fox jumps over the lazy dog
```

`str_replace_last()`
```php
$replaced = str_replace_last('the', 'a', 'the quick brown fox jumps over the lazy dog');

// the quick brown fox jumps over a lazy dog
```

`str_singular()`
```php
$singular = str_singular('cars');

// car

$singular = str_singular('children');

// child
```

`str_slug()`
```php
$slug = str_slug('Chris The Coder', '-');

// chris-the-coder
```

`str_snake()`
```php
$converted = str_snake('fooBar');

// foo_bar
```

`str_start()`
```php
$adjusted = str_start('this/string', '/');

// /this/string

$adjusted = str_start('/this/string', '/');

// /this/string
```

`str_starts_with()`
```php
$result = str_starts_with('This is my name', 'This');

// true
```

`str_studly()`
```php
$converted = str_studly('foo_bar');

// FooBar
```

`str_title()`
```php
$converted = str_title('a nice title uses the correct case');

// A Nice Title Uses The Correct Case
```

`str_ucfirst()`
```php
$string = str_ucfirst('foo bar');

// Foo bar
```

`str_upper()`
```php
$string = str_upper('chris');

// CHRIS
```

`str_uuid()`
```php
return (string) str_uuid();
```

`str_words()`
```php
return str_words('Perfectly balanced, as all things should be.', 3, ' >>>');

// Perfectly balanced, as >>>
```
