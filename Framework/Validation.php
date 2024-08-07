<?php

namespace Framework;

class Validation
{

    /**
     * Validates a string
     *
     * @param string $value
     * @param integer $min
     * @param integer $max
     * @return boolean
     */
    public static function string(string $value, int $min = 1, int $max = 9999999): bool
    {
        if (is_string($value)) {
            $value = trim($value);
            $length = strlen($value);

            return $length >= $min && $length <= $max;
        }

        return false;
    }

    /**
     * Validates an email
     *
     * @param string $value
     * @return mixed
     */
    public static function email($value): string | false
    {
        $value = trim($value);

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }


    /**
     * Match a value against another
     *
     * @param string $value1
     * @param string $value2
     * @return boolean
     */
    public static function matchPassword(string $value1, string $value2): bool
    {
        $value1 = trim($value1);
        $value2 = trim($value2);

        return $value1 === $value2;
    }
}
