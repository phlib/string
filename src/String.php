<?php

declare(strict_types=1);

namespace Phlib\String;

function ellipsis(string $string, int $maxLength, string $ellipsis = '...'): string
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
        return mb_substr($string, 0, $maxLength - $ellipsisLength) . $ellipsis;
    }
    return $string;
}
