<?php

namespace Phlib\String;

/**
 * @param string $string
 * @param int $maxLength
 * @param string $ellipsis
 * @return string
 */
function ellipsis($string, $maxLength, $ellipsis = '...')
{
    $options = array(
        'options' => array(
            'min_range' => 1,
            'max_range' => PHP_INT_MAX
        )
    );
    $invalid = (filter_var($maxLength, FILTER_VALIDATE_INT, $options) === false);
    if ($invalid) {
        throw new \InvalidArgumentException("Cannot use value provided as maxlength '$maxLength'");
    }

    if (strlen($string) > $maxLength) {
        return substr($string, 0, $maxLength - strlen($ellipsis)) . $ellipsis;
    }
    return $string;
}
