<?php

declare(strict_types=1);

namespace Phlib\String;

use PHPUnit\Framework\TestCase;

class ToBooleanTest extends TestCase
{
    /**
     * @dataProvider dataConvert
     */
    public function testConvert(string $string, bool $expected): void
    {
        static::assertSame($expected, toBoolean($string));
    }

    public function dataConvert(): iterable
    {
        // Mapping from the function
        $mapping = [
            'yes' => ['yes', true],
            'no' => ['no', false],
            'y' => ['y', true],
            'n' => ['n', false],
            'true' => ['true', true],
            'false' => ['false', false],
            'num 1' => ['1', true],
            'num 0' => ['0', false],
        ];
        yield from $mapping;

        // Different cases gives the same result
        foreach ($mapping as $name => $data) {
            yield 'case-upper-' . $name => [
                strtoupper($data[0]),
                $data[1],
            ];
            yield 'case-ucfirst-' . $name => [
                ucfirst($data[0]),
                $data[1],
            ];
        }

        // Spacing
        $spaces = [
            'space' => ' ',
            'CR' => "\r",
            'LF' => "\n",
            'CRLF' => "\r\n",
        ];
        $testValues = [
            'yes' => true,
            'no' => false,
            '1' => true,
            '0' => false,
        ];
        foreach ($spaces as $name => $chr) {
            foreach ($testValues as $input => $expected) {
                yield "space-{$name}-before-{$input}" => [
                    $chr . $input,
                    $expected,
                ];
                yield "space-{$name}-after-{$input}" => [
                    $input . $chr,
                    $expected,
                ];
                yield "space-{$name}-both-{$input}" => [
                    $chr . $input . $chr,
                    $expected,
                ];
                yield "space-{$name}-multi-{$input}" => [
                    $chr . $chr . $chr . $input . $chr . $chr . $chr,
                    $expected,
                ];
            }
        }

        // Alternate numbers
        yield from [
            'num 123' => ['123', true],
            'num 4.5' => ['4.5', true],
            'num 0000' => ['0000', true],
            'num 0001' => ['0001', true],
        ];

        // Other strings
        yield from [
            'foo' => ['foo', true],
            'empty' => ['', false],
        ];
    }
}
