<?php

declare(strict_types=1);

namespace Phlib\String;

function ellipsis(string $string, int $maxLength, string $ellipsis = '...'): string
{
    $options = [
        'options' => [
            'min_range' => 1,
            'max_range' => PHP_INT_MAX,
        ],
    ];
    $invalid = (filter_var($maxLength, FILTER_VALIDATE_INT, $options) === false);
    if ($invalid) {
        throw new \InvalidArgumentException("Cannot use value provided as maxlength '{$maxLength}'");
    }

    if (strlen($string) > $maxLength) {
        return substr($string, 0, $maxLength - strlen($ellipsis)) . $ellipsis;
    }
    return $string;
}

function toBoolean(string $value)
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
