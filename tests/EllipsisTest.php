<?php

declare(strict_types=1);

namespace Phlib\String;

use PHPUnit\Framework\TestCase;

class EllipsisTest extends TestCase
{
    /**
     * @dataProvider dataEllipsis
     */
    public function testEllipsis(
        string $input,
        int $maxLength,
        ?string $ellipsis,
        ?string $breakAt,
        string $expected
    ): void {
        if ($ellipsis === null) {
            $actual = ellipsis($input, $maxLength);
        } else {
            $actual = ellipsis($input, $maxLength, $ellipsis, $breakAt);
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
                'breakAt' => null,
                'expected' => 'Hello world',
            ],
            'default' => [
                'input' => 'Hello world',
                'max' => 10,
                'ellipsis' => null,
                'breakAt' => null,
                'expected' => 'Hello w...',
            ],
            'short' => [
                'input' => 'Hello world',
                'max' => 4,
                'ellipsis' => null,
                'breakAt' => null,
                'expected' => 'H...',
            ],
            'custom' => [
                'input' => 'Hello world',
                'max' => 10,
                'ellipsis' => ',,,',
                'breakAt' => null,
                'expected' => 'Hello w,,,',
            ],
            'custom length' => [
                'input' => 'Hello world',
                'max' => 10,
                'ellipsis' => ';;;;',
                'breakAt' => null,
                'expected' => 'Hello ;;;;',
            ],
            'break' => [
                // Without break, result at 25 would be 'Hello world needle hay...'
                'input' => 'Hello world needle haystack',
                'max' => 25,
                'ellipsis' => '...',
                'breakAt' => ' ',
                'expected' => 'Hello world needle...',
            ],
            'break not found' => [
                // Standard behaviour when the break character isn't matched
                'input' => 'Hello world needle haystack',
                'max' => 25,
                'ellipsis' => '...',
                'breakAt' => ',',
                'expected' => 'Hello world needle hay...',
            ],
            'break empty' => [
                // Standard behaviour when the break character isn't set
                'input' => 'Hello world needle haystack',
                'max' => 25,
                'ellipsis' => '...',
                'breakAt' => '',
                'expected' => 'Hello world needle hay...',
            ],
            'mbstring input' => [
                // Robot is 4-byte character, https://www.fileformat.info/info/unicode/char/1f916/index.htm
                // Without multibyte support, robot will be broken after 3 bytes
                'input' => 'Hello 🤖 world',
                'max' => 12,
                'ellipsis' => null,
                'breakAt' => null,
                'expected' => 'Hello 🤖 w...',
            ],
            'mbstring input with break' => [
                'input' => 'Hello world needle 🤖 haystack',
                'max' => 27,
                'ellipsis' => '...',
                'breakAt' => ' ',
                'expected' => 'Hello world needle 🤖...',
            ],
            'mbstring ellipsis' => [
                // Without multibyte support, ellipsis length would be counted as 12
                'input' => 'Hello world',
                'max' => 10,
                'ellipsis' => '🤖🤖🤖',
                'breakAt' => null,
                'expected' => 'Hello w🤖🤖🤖',
            ],
            'mbstring break' => [
                'input' => 'Hello🤖world🤖needle🤖haystack',
                'max' => 25,
                'ellipsis' => '...',
                'breakAt' => '🤖',
                'expected' => 'Hello🤖world🤖needle...',
            ],
        ];
    }

    /**
     * @dataProvider dataInvalidMaxLength
     */
    public function testInvalidMaxLength(int $maxLength, ?string $ellipsis): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot use value provided as maxlength');

        if ($ellipsis === null) {
            ellipsis('Hello world', $maxLength);
        } else {
            ellipsis('Hello world', $maxLength, $ellipsis);
        }
    }

    public function dataInvalidMaxLength(): array
    {
        return [
            'zero' => [
                'max' => 0,
                'ellipsis' => null,
            ],
            'short' => [
                'max' => 3,
                'ellipsis' => null,
            ],
            'short custom' => [
                'max' => 4,
                'ellipsis' => ';;;;',
            ],
        ];
    }
}
