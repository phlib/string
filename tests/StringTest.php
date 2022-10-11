<?php

declare(strict_types=1);

namespace Phlib\String;

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    public function testNoEllipsis(): void
    {
        static::assertSame('Hello world', ellipsis('Hello world', 100));
    }

    public function testDefaultEllipsis(): void
    {
        static::assertSame('Hello w...', ellipsis('Hello world', 10));
    }

    public function testCustomEllipsis(): void
    {
        static::assertSame('Hello w,,,', ellipsis('Hello world', 10, ',,,'));
    }

    public function testCustomEllipsisDifferentLength(): void
    {
        static::assertSame('Hello ;;;;', ellipsis('Hello world', 10, ';;;;'));
    }

    public function testInvalidLengthZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        ellipsis('Hello world', 0);
    }
}
