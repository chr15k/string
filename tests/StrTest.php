<?php

namespace Chr15k\String\Test;

use Chr15k\String\Str;
use Ramsey\Uuid\UuidInterface;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testStringPossessive()
    {
        $this->assertSame("Chris'", Str::possessive('Chris'));
        $this->assertSame("David's", Str::possessive('David'));
        $this->assertSame("its", Str::possessive('it'));
        $this->assertSame("Erin's", Str::possessive('Erin'));
        $this->assertSame("James'", Str::possessive('James'));
        $this->assertSame("Chris'", Str::possessive("Chris'"));
    }

	public function testStringCanBeLimitedByWords()
    {
        $this->assertSame('Chris...', Str::words('Chris Tel Kel', 1));
        $this->assertSame('Chris___', Str::words('Chris Tel Kel', 1, '___'));
        $this->assertSame('Chris Tel Kel', Str::words('Chris Tel Kel', 3));
    }

    public function testStringTrimmedOnlyWhereNecessary()
    {
        $this->assertSame(' Chris Tel Kel ', Str::words(' Chris Tel Kel ', 3));
        $this->assertSame(' Chris...', Str::words(' Chris Tel Kel ', 1));
    }

    public function testStringTitle()
    {
        $this->assertSame('Jefferson Costella', Str::title('jefferson costella'));
        $this->assertSame('Jefferson Costella', Str::title('jefFErson coSTella'));
    }

    public function testStringWithoutWordsDoesntProduceError()
    {
        $nbsp = chr(0xC2).chr(0xA0);
        $this->assertSame(' ', Str::words(' '));
        $this->assertEquals($nbsp, Str::words($nbsp));
    }

    public function testStringAscii()
    {
        $this->assertSame('@', Str::ascii('@'));
        $this->assertSame('u', Str::ascii('ü'));
    }

    public function testStringAsciiWithSpecificLocale()
    {
        $this->assertSame('h H sht Sht a A ia yo', Str::ascii('х Х щ Щ ъ Ъ иа йо', 'bg'));
        $this->assertSame('ae oe ue Ae Oe Ue', Str::ascii('ä ö ü Ä Ö Ü', 'de'));
    }

    public function testStartsWith()
    {
        $this->assertTrue(Str::startsWith('chris', 'chr'));
        $this->assertTrue(Str::startsWith('chris', 'chris'));
        $this->assertTrue(Str::startsWith('chris', ['chr']));
        $this->assertTrue(Str::startsWith('chris', ['day', 'chr']));
        $this->assertFalse(Str::startsWith('chris', 'day'));
        $this->assertFalse(Str::startsWith('chris', ['day']));
        $this->assertFalse(Str::startsWith('chris', null));
        $this->assertFalse(Str::startsWith('chris', [null]));
        $this->assertFalse(Str::startsWith('0123', [null]));
        $this->assertTrue(Str::startsWith('0123', 0));
        $this->assertFalse(Str::startsWith('chris', 'C'));
        $this->assertFalse(Str::startsWith('chris', ''));
        $this->assertFalse(Str::startsWith('7', ' 7'));
        $this->assertTrue(Str::startsWith('7a', '7'));
        $this->assertTrue(Str::startsWith('7a', 7));
        $this->assertTrue(Str::startsWith('7.12a', 7.12));
        $this->assertFalse(Str::startsWith('7.12a', 7.13));
        $this->assertTrue(Str::startsWith(7.123, '7'));
        $this->assertTrue(Str::startsWith(7.123, '7.12'));
        $this->assertFalse(Str::startsWith(7.123, '7.13'));
        // Test for multibyte string support
        $this->assertTrue(Str::startsWith('Jönköping', 'Jö'));
        $this->assertTrue(Str::startsWith('Malmö', 'Malmö'));
        $this->assertFalse(Str::startsWith('Jönköping', 'Jonko'));
        $this->assertFalse(Str::startsWith('Malmö', 'Malmo'));
        $this->assertTrue(Str::startsWith('你好', '你'));
        $this->assertFalse(Str::startsWith('你好', '好'));
        $this->assertFalse(Str::startsWith('你好', 'a'));
    }

    public function testEndsWith()
    {
        $this->assertTrue(Str::endsWith('chris', 'is'));
        $this->assertTrue(Str::endsWith('chris', 'chris'));
        $this->assertTrue(Str::endsWith('chris', ['is']));
        $this->assertTrue(Str::endsWith('chris', ['si', 'is']));
        $this->assertFalse(Str::endsWith('chris', 'si'));
        $this->assertFalse(Str::endsWith('chris', ['si']));
        $this->assertFalse(Str::endsWith('chris', ''));
        $this->assertFalse(Str::endsWith('chris', [null]));
        $this->assertFalse(Str::endsWith('chris', null));
        $this->assertFalse(Str::endsWith('chris', 'C'));
        $this->assertFalse(Str::endsWith('7', ' 7'));
        $this->assertTrue(Str::endsWith('a7', '7'));
        $this->assertTrue(Str::endsWith('a7', 7));
        $this->assertTrue(Str::endsWith('a7.12', 7.12));
        $this->assertFalse(Str::endsWith('a7.12', 7.13));
        $this->assertTrue(Str::endsWith(0.27, '7'));
        $this->assertTrue(Str::endsWith(0.27, '0.27'));
        $this->assertFalse(Str::endsWith(0.27, '8'));
        // Test for multibyte string support
        $this->assertTrue(Str::endsWith('Jönköping', 'öping'));
        $this->assertTrue(Str::endsWith('Malmö', 'mö'));
        $this->assertFalse(Str::endsWith('Jönköping', 'oping'));
        $this->assertFalse(Str::endsWith('Malmö', 'mo'));
        $this->assertTrue(Str::endsWith('你好', '好'));
        $this->assertFalse(Str::endsWith('你好', '你'));
        $this->assertFalse(Str::endsWith('你好', 'a'));
    }

    public function testStrBefore()
    {
        $this->assertSame('han', Str::before('hannah', 'nah'));
        $this->assertSame('ha', Str::before('hannah', 'n'));
        $this->assertSame('ééé ', Str::before('ééé hannah', 'han'));
        $this->assertSame('hannah', Str::before('hannah', 'xxxx'));
        $this->assertSame('hannah', Str::before('hannah', ''));
        $this->assertSame('han', Str::before('han0nah', '0'));
        $this->assertSame('han', Str::before('han0nah', 0));
        $this->assertSame('han', Str::before('han2nah', 2));
    }

    public function testStrBeforeLast()
    {
        $this->assertSame('yve', Str::beforeLast('yvette', 'tte'));
        $this->assertSame('yvet', Str::beforeLast('yvette', 't'));
        $this->assertSame('ééé ', Str::beforeLast('ééé yvette', 'yve'));
        $this->assertSame('', Str::beforeLast('yvette', 'yve'));
        $this->assertSame('yvette', Str::beforeLast('yvette', 'xxxx'));
        $this->assertSame('yvette', Str::beforeLast('yvette', ''));
        $this->assertSame('yv0et', Str::beforeLast('yv0et0te', '0'));
        $this->assertSame('yv0et', Str::beforeLast('yv0et0te', 0));
        $this->assertSame('yv2et', Str::beforeLast('yv2et2te', 2));
    }

    public function testStrBetween()
    {
        $this->assertSame('abc', Str::between('abc', '', 'c'));
        $this->assertSame('abc', Str::between('abc', 'a', ''));
        $this->assertSame('abc', Str::between('abc', '', ''));
        $this->assertSame('b', Str::between('abc', 'a', 'c'));
        $this->assertSame('b', Str::between('dddabc', 'a', 'c'));
        $this->assertSame('b', Str::between('abcddd', 'a', 'c'));
        $this->assertSame('b', Str::between('dddabcddd', 'a', 'c'));
        $this->assertSame('nn', Str::between('hannah', 'ha', 'ah'));
        $this->assertSame('a]ab[b', Str::between('[a]ab[b]', '[', ']'));
        $this->assertSame('foo', Str::between('foofoobar', 'foo', 'bar'));
        $this->assertSame('bar', Str::between('foobarbar', 'foo', 'bar'));
    }

    public function testStrAfter()
    {
        $this->assertSame('nah', Str::after('hannah', 'han'));
        $this->assertSame('nah', Str::after('hannah', 'n'));
        $this->assertSame('nah', Str::after('ééé hannah', 'han'));
        $this->assertSame('hannah', Str::after('hannah', 'xxxx'));
        $this->assertSame('hannah', Str::after('hannah', ''));
        $this->assertSame('nah', Str::after('han0nah', '0'));
        $this->assertSame('nah', Str::after('han0nah', 0));
        $this->assertSame('nah', Str::after('han2nah', 2));
    }

    public function testStrAfterLast()
    {
        $this->assertSame('tte', Str::afterLast('yvette', 'yve'));
        $this->assertSame('e', Str::afterLast('yvette', 't'));
        $this->assertSame('e', Str::afterLast('ééé yvette', 't'));
        $this->assertSame('', Str::afterLast('yvette', 'tte'));
        $this->assertSame('yvette', Str::afterLast('yvette', 'xxxx'));
        $this->assertSame('yvette', Str::afterLast('yvette', ''));
        $this->assertSame('te', Str::afterLast('yv0et0te', '0'));
        $this->assertSame('te', Str::afterLast('yv0et0te', 0));
        $this->assertSame('te', Str::afterLast('yv2et2te', 2));
        $this->assertSame('foo', Str::afterLast('----foo', '---'));
    }

    public function testStrContains()
    {
        $this->assertTrue(Str::contains('chris', 'ris'));
        $this->assertTrue(Str::contains('chris', 'chris'));
        $this->assertTrue(Str::contains('chris', ['chr']));
        $this->assertTrue(Str::contains('chris', ['xxx', 'hri']));
        $this->assertFalse(Str::contains('chris', 'xxx'));
        $this->assertFalse(Str::contains('chris', ['xxx']));
        $this->assertFalse(Str::contains('chris', ''));
    }

    public function testStrContainsAll()
    {
        $this->assertTrue(Str::containsAll('chris keller', ['chris', 'keller']));
        $this->assertTrue(Str::containsAll('chris keller', ['chris']));
        $this->assertFalse(Str::containsAll('chris keller', ['chris', 'xxx']));
    }

    public function testSlug()
    {
        $this->assertSame('hello-world', Str::slug('hello world'));
        $this->assertSame('hello-world', Str::slug('hello-world'));
        $this->assertSame('hello-world', Str::slug('hello_world'));
        $this->assertSame('hello_world', Str::slug('hello_world', '_'));
        $this->assertSame('user-at-host', Str::slug('user@host'));
        $this->assertSame('سلام-دنیا', Str::slug('سلام دنیا', '-', null));
        $this->assertSame('sometext', Str::slug('some text', ''));
        $this->assertSame('', Str::slug('', ''));
        $this->assertSame('', Str::slug(''));
    }

    public function testStrStart()
    {
        $this->assertSame('/test/string', Str::start('test/string', '/'));
        $this->assertSame('/test/string', Str::start('/test/string', '/'));
        $this->assertSame('/test/string', Str::start('//test/string', '/'));
    }

    public function testFinish()
    {
        $this->assertSame('abbc', Str::finish('ab', 'bc'));
        $this->assertSame('abbc', Str::finish('abbcbc', 'bc'));
        $this->assertSame('abcbbc', Str::finish('abcbbcbc', 'bc'));
    }

    public function testMatch()
    {
        $this->assertTrue(Str::match('/', '/'));
        $this->assertFalse(Str::match('/', ' /'));
        $this->assertFalse(Str::match('/', '/a'));
        $this->assertTrue(Str::match('foo/*', 'foo/bar/baz'));

        $this->assertTrue(Str::match('*@*', 'App\Class@method'));
        $this->assertTrue(Str::match('*@*', 'app\Class@'));
        $this->assertTrue(Str::match('*@*', '@method'));

        // is case sensitive
        $this->assertFalse(Str::match('*BAZ*', 'foo/bar/baz'));
        $this->assertFalse(Str::match('*FOO*', 'foo/bar/baz'));
        $this->assertFalse(Str::match('A', 'a'));

        // Accepts array of patterns
        $this->assertTrue(Str::match(['a*', 'b*'], 'a/'));
        $this->assertTrue(Str::match(['a*', 'b*'], 'b/'));
        $this->assertFalse(Str::match(['a*', 'b*'], 'f/'));

        // numeric values and patterns
        $this->assertFalse(Str::match(['a*', 'b*'], 123));
        $this->assertTrue(Str::match(['*2*', 'b*'], 11211));

        $this->assertTrue(Str::match('*/foo', 'blah/baz/foo'));

        // empty patterns
        $this->assertFalse(Str::match([], 'test'));
    }

    /**
     * @dataProvider validUuidList
     */
    public function testIsUuidWithValidUuid($uuid)
    {
        $this->assertTrue(Str::isUuid($uuid));
    }

    /**
     * @dataProvider invalidUuidList
     */
    public function testIsUuidWithInvalidUuid($uuid)
    {
        $this->assertFalse(Str::isUuid($uuid));
    }

    public function testKebab()
    {
        $this->assertSame('chris-tel-kel', Str::kebab('ChrisTelKel'));
    }

    public function testLower()
    {
        $this->assertSame('chris tel kel', Str::lower('CHRIS TEL KEL'));
        $this->assertSame('chris tel kel', Str::lower('ChRIs TeL kEl'));
    }

    public function testUpper()
    {
        $this->assertSame('CHRIS TEL KEL', Str::upper('CHRIS TEL KEL'));
        $this->assertSame('CHRIS TEL KEL', Str::upper('ChRIs TeL kEl'));
    }

    public function testLimit()
    {
        $this->assertSame('I love pro...', Str::limit('I love programming', 10));
        $this->assertSame('这是一...', Str::limit('这是一段中文', 6));

        $string = 'I love programming, and pizza.';
        $this->assertSame('I love...', Str::limit($string, 7));
        $this->assertSame('I love', Str::limit($string, 7, ''));
        $this->assertSame('I love programming, and pizza.', Str::limit($string, 100));

        $nonAsciiString = '这是一段中文';
        $this->assertSame('这是一...', Str::limit($nonAsciiString, 6));
        $this->assertSame('这是一', Str::limit($nonAsciiString, 6, ''));
    }

    public function testLength()
    {
        $this->assertEquals(11, Str::length('foo bar baz'));
        $this->assertEquals(11, Str::length('foo bar baz', 'UTF-8'));
    }

    public function testRandom()
    {
        $this->assertEquals(16, strlen(Str::random()));
        $randomInteger = random_int(1, 100);
        $this->assertEquals($randomInteger, strlen(Str::random($randomInteger)));
        $this->assertIsString(Str::random());
    }

    public function testReplaceArray()
    {
        $this->assertSame('foo/bar/baz', Str::replaceArray('?', ['foo', 'bar', 'baz'], '?/?/?'));
        $this->assertSame('foo/bar/baz/?', Str::replaceArray('?', ['foo', 'bar', 'baz'], '?/?/?/?'));
        $this->assertSame('foo/bar', Str::replaceArray('?', ['foo', 'bar', 'baz'], '?/?'));
        $this->assertSame('?/?/?', Str::replaceArray('x', ['foo', 'bar', 'baz'], '?/?/?'));
        // Ensure recursive replacements are avoided
        $this->assertSame('foo?/bar/baz', Str::replaceArray('?', ['foo?', 'bar', 'baz'], '?/?/?'));
        // Test for associative array support
        $this->assertSame('foo/bar', Str::replaceArray('?', [1 => 'foo', 2 => 'bar'], '?/?'));
        $this->assertSame('foo/bar', Str::replaceArray('?', ['x' => 'foo', 'y' => 'bar'], '?/?'));
    }

    public function testReplaceFirst()
    {
        $this->assertSame('fooqux foobar', Str::replaceFirst('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/qux? foo/bar?', Str::replaceFirst('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('foo foobar', Str::replaceFirst('bar', '', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceFirst('xxx', 'yyy', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceFirst('', 'yyy', 'foobar foobar'));
        // Test for multibyte string support
        $this->assertSame('Jxxxnköping Malmö', Str::replaceFirst('ö', 'xxx', 'Jönköping Malmö'));
        $this->assertSame('Jönköping Malmö', Str::replaceFirst('', 'yyy', 'Jönköping Malmö'));
    }

    public function testReplaceLast()
    {
        $this->assertSame('foobar fooqux', Str::replaceLast('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/bar? foo/qux?', Str::replaceLast('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('foobar foo', Str::replaceLast('bar', '', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceLast('xxx', 'yyy', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceLast('', 'yyy', 'foobar foobar'));
        // Test for multibyte string support
        $this->assertSame('Malmö Jönkxxxping', Str::replaceLast('ö', 'xxx', 'Malmö Jönköping'));
        $this->assertSame('Malmö Jönköping', Str::replaceLast('', 'yyy', 'Malmö Jönköping'));
    }

    public function testSnake()
    {
        $this->assertSame('laravel_p_h_p_framework', Str::snake('LaravelPHPFramework'));
        $this->assertSame('laravel_php_framework', Str::snake('LaravelPhpFramework'));
        $this->assertSame('laravel php framework', Str::snake('LaravelPhpFramework', ' '));
        $this->assertSame('laravel_php_framework', Str::snake('Laravel Php Framework'));
        $this->assertSame('laravel_php_framework', Str::snake('Laravel    Php      Framework   '));
        // ensure cache keys don't overlap
        $this->assertSame('laravel__php__framework', Str::snake('LaravelPhpFramework', '__'));
        $this->assertSame('laravel_php_framework_', Str::snake('LaravelPhpFramework_', '_'));
        $this->assertSame('laravel_php_framework', Str::snake('laravel php Framework'));
        $this->assertSame('laravel_php_frame_work', Str::snake('laravel php FrameWork'));
        // prevent breaking changes
        $this->assertSame('foo-bar', Str::snake('foo-bar'));
        $this->assertSame('foo-_bar', Str::snake('Foo-Bar'));
        $this->assertSame('foo__bar', Str::snake('Foo_Bar'));
        $this->assertSame('żółtałódka', Str::snake('ŻółtaŁódka'));
    }

    public function testStudly()
    {
        $this->assertSame('LaravelPHPFramework', Str::studly('laravel_p_h_p_framework'));
        $this->assertSame('LaravelPhpFramework', Str::studly('laravel_php_framework'));
        $this->assertSame('LaravelPhPFramework', Str::studly('laravel-phP-framework'));
        $this->assertSame('LaravelPhpFramework', Str::studly('laravel  -_-  php   -_-   framework   '));

        $this->assertSame('FooBar', Str::studly('fooBar'));
        $this->assertSame('FooBar', Str::studly('foo_bar'));
        $this->assertSame('FooBar', Str::studly('foo_bar')); // test cache
        $this->assertSame('FooBarBaz', Str::studly('foo-barBaz'));
        $this->assertSame('FooBarBaz', Str::studly('foo-bar_baz'));
    }

    public function testCamel()
    {
        $this->assertSame('laravelPHPFramework', Str::camel('Laravel_p_h_p_framework'));
        $this->assertSame('laravelPhpFramework', Str::camel('Laravel_php_framework'));
        $this->assertSame('laravelPhPFramework', Str::camel('Laravel-phP-framework'));
        $this->assertSame('laravelPhpFramework', Str::camel('Laravel  -_-  php   -_-   framework   '));

        $this->assertSame('fooBar', Str::camel('FooBar'));
        $this->assertSame('fooBar', Str::camel('foo_bar'));
        $this->assertSame('fooBar', Str::camel('foo_bar')); // test cache
        $this->assertSame('fooBarBaz', Str::camel('Foo-barBaz'));
        $this->assertSame('fooBarBaz', Str::camel('foo-bar_baz'));
    }

    public function testSubstr()
    {
        $this->assertSame('Ё', Str::substr('БГДЖИЛЁ', -1));
        $this->assertSame('ЛЁ', Str::substr('БГДЖИЛЁ', -2));
        $this->assertSame('И', Str::substr('БГДЖИЛЁ', -3, 1));
        $this->assertSame('ДЖИЛ', Str::substr('БГДЖИЛЁ', 2, -1));
        $this->assertEmpty(Str::substr('БГДЖИЛЁ', 4, -4));
        $this->assertSame('ИЛ', Str::substr('БГДЖИЛЁ', -3, -1));
        $this->assertSame('ГДЖИЛЁ', Str::substr('БГДЖИЛЁ', 1));
        $this->assertSame('ГДЖ', Str::substr('БГДЖИЛЁ', 1, 3));
        $this->assertSame('БГДЖ', Str::substr('БГДЖИЛЁ', 0, 4));
        $this->assertSame('Ё', Str::substr('БГДЖИЛЁ', -1, 1));
        $this->assertEmpty(Str::substr('Б', 2));
    }

    public function testSubstrCount()
    {
        $this->assertSame(3, Str::substrCount('laravelPHPFramework', 'a'));
        $this->assertSame(0, Str::substrCount('laravelPHPFramework', 'z'));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'l', 2));
        $this->assertSame(0, Str::substrCount('laravelPHPFramework', 'z', 2));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'k', -1));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'k', -1));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'a', 1, 2));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'a', 1, 2));
        $this->assertSame(3, Str::substrCount('laravelPHPFramework', 'a', 1, -2));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'a', -10, -3));
    }

    public function testUcfirst()
    {
        $this->assertSame('Chris', Str::ucfirst('chris'));
        $this->assertSame('Chris tel kel', Str::ucfirst('chris tel kel'));
    }

    public function testUuid()
    {
        $this->assertInstanceOf(UuidInterface::class, Str::uuid());
        $this->assertInstanceOf(UuidInterface::class, Str::orderedUuid());
    }

    public function testAsciiNull()
    {
        $this->assertSame('', Str::ascii(null));
        $this->assertTrue(Str::isAscii(null));
        $this->assertSame('', Str::slug(null));
    }

    public function validUuidList()
    {
        return [
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de'],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1'],
            ['00000000-0000-0000-0000-000000000000'],
            ['e60d3f48-95d7-4d8d-aad0-856f29a27da2'],
            ['ff6f8cb0-c57d-11e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-31e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-41e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-51e1-9b21-0800200c9a66'],
            ['FF6F8CB0-C57D-11E1-9B21-0800200C9A66'],
        ];
    }

    public function invalidUuidList()
    {
        return [
            ['not a valid uuid so we can test this'],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66'],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1'.PHP_EOL],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1 '],
            [' 145a1e72-d11d-11e8-a8d5-f2801f1b9fd1'],
            ['145a1e72-d11d-11e8-a8d5-f2z01f1b9fd1'],
            ['3f6f8cb0-c57d-11e1-9b21-0800200c9a6'],
            ['af6f8cb-c57d-11e1-9b21-0800200c9a66'],
            ['af6f8cb0c57d11e19b210800200c9a66'],
            ['ff6f8cb0-c57da-51e1-9b21-0800200c9a66'],
        ];
    }
}
