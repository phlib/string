<?php

namespace Phlib\String;

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    public function testNoEllipsis()
    {
        static::assertSame('Hello world', ellipsis('Hello world', 100));
    }

    public function testDefaultEllipsis()
    {
        static::assertSame('Hello w...', ellipsis('Hello world', 10));
    }

    public function testCustomEllipsis()
    {
        static::assertSame('Hello w,,,', ellipsis('Hello world', 10, ',,,'));
    }

    public function testCustomEllipsisDifferentLength()
    {
        static::assertSame('Hello ;;;;', ellipsis('Hello world', 10, ';;;;'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLengthZero()
    {
        ellipsis('Hello world', 0);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLengthWord()
    {
        ellipsis('Hello world', 'oops');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLengthTooBig()
    {
        ellipsis('Hello world', PHP_INT_MAX + 1);
    }
}
