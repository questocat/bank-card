<?php

if (!function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param array  $array
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    function array_get($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }

        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }
}

if (!function_exists('card_format')) {
    /**
     * Formats a number as a bank card edit text.
     *
     * @param string $cardNumber
     *
     * @return string
     */
    function card_format($cardNumber)
    {
        preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{4})([\d]{0,})?/', $cardNumber, $match);
        array_shift($match);

        return implode(' ', $match);
    }
}

if (!function_exists('card_bin')) {
    /**
     * Returns the card BIN of bank card number.
     *
     * @param string $cardNumber
     *
     * @return string
     */
    function card_bin($cardNumber)
    {
        return substr($cardNumber, 0, 6);
    }
}
