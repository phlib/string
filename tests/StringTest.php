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
        ];
    }

    public function testInvalidLengthZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        ellipsis('Hello world', 0);
    }
}
