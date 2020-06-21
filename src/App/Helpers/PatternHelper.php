<?php

namespace App\Helpers;

/**
 * Helper class to deal with some string patterns
 *
 * Class PatternHelper
 *
 * @package App\Helpers
 */
class PatternHelper
{
    /**
     * Check if a given string has an initials pattern
     *
     * @param string $data
     *
     * @return bool
     */
    public static function isInitial(string $data)
    {
        return strlen($data) == 1 || strlen($data) == 2 && strpos($data, '.');
    }

    /**
     * Checks if a string is divided by provided pattern
     *
     * @param $data
     * @param $rules
     *
     * @return bool|mixed
     */
    public static function isMultiple($data, $rules)
    {
        foreach ($rules as $separator) {
            if (preg_match('/\b' . $separator . '\b|\B' . $separator . '\B/', $data, $matches)) {
                return current($matches);
            }
        }

        return false;
    }
}
