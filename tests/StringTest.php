<?php

declare(strict_types=1);

namespace Phlib\String;

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    /**
     * @dataProvider dataEllipsis
     */
    public function testEllipsis(string $input, int $maxLength, ?string $ellipsis, string $expected): void
    {
        if ($ellipsis === null) {
            $actual = ellipsis($input, $maxLength);
        } else {
            $actual = ellipsis($input, $maxLength, $ellipsis);
        }
        static::assertSame($expected, $actual);
    }

    public function dataEllipsis(): array
    {
        return [
            'none' => [
                'input' => 'Hello world',
                'max' => 100,
                'ellipsis' => null,
                'expected' => 'Hello world',
            ],
            'default' => [
                'input' => 'Hello world',
                'max' => 10,
                'ellipsis' => null,
                'expected' => 'Hello w...',
            ],
            'custom' => [
                'input' => 'Hello world',
                'max' => 10,
                'ellipsis' => ',,,',
                'expected' => 'Hello w,,,',
            ],
            'custom length' => [
                'input' => 'Hello world',
                'max' => 10,
                'ellipsis' => ';;;;',
                'expected' => 'Hello ;;;;',
            ],
            'mbstring input' => [
                // Robot is 4-byte character, https://www.fileformat.info/info/unicode/char/1f916/index.htm
                // Without multibyte support, robot will be broken after 3 bytes
                'input' => 'Hello 🤖 world',
                'max' => 12,
                'ellipsis' => null,
                'expected' => 'Hello 🤖 w...',
            ],
            'mbstring ellipsis' => [
                // Without multibyte support, ellipsis length would be counted as 12
                'input' => 'Hello world',
                'max' => 10,
                'ellipsis' => '🤖🤖🤖',
                'expected' => 'Hello w🤖🤖🤖',
            ],
        ];
    }

    public function testInvalidLengthZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        ellipsis('Hello world', 0);
    }
}
