<?php

declare(strict_types=1);

namespace Phlib\String;

function ellipsis(string $string, int $maxLength, string $ellipsis = '...', string $breakAt = null): string
{
    $ellipsisLength = mb_strlen($ellipsis);
    $options = [
        'options' => [
            'min_range' => 1 + $ellipsisLength,
            'max_range' => PHP_INT_MAX,
        ],
    ];
    $invalid = (filter_var($maxLength, FILTER_VALIDATE_INT, $options) === false);
    if ($invalid) {
        throw new \InvalidArgumentException("Cannot use value provided as maxlength '{$maxLength}'");
    }

    if (mb_strlen($string) > $maxLength) {
        $str = mb_substr($string, 0, $maxLength - $ellipsisLength);
        if ($breakAt !== null) {
            $lastBreakPos = mb_strrpos($str, $breakAt);
            if ($lastBreakPos > 0) {
                $str = mb_substr($str, 0, $lastBreakPos);
            }
        }
        return $str . $ellipsis;
    }
    return $string;
}

function toBoolean(string $value): bool
{
    $bools = [
        'yes' => true,
        'no' => false,
        'y' => true,
        'n' => false,
        'true' => true,
        'false' => false,
        '1' => true,
        '0' => false,
    ];

    $value = strtolower(trim($value));
    if (array_key_exists($value, $bools)) {
        return $bools[$value];
    }

    return (bool)$value;
}
