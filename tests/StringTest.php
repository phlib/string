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

    public function testInvalidLengthZero()
    {
        $this->expectException(\InvalidArgumentException::class);

        ellipsis('Hello world', 0);
    }

    public function testInvalidLengthWord()
    {
        $this->expectException(\InvalidArgumentException::class);

        ellipsis('Hello world', 'oops');
    }

    public function testInvalidLengthTooBig()
    {
        $this->expectException(\InvalidArgumentException::class);

        ellipsis('Hello world', PHP_INT_MAX + 1);
    }
}
