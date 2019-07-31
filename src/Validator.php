<?php

namespace Mvdnbrk\Gtin;

class Validator
{
    /**
     * Checks whether the given value is a valid
     * Global Trade Item Number (GTIN).
     *
     * @param  string|int  $value
     * @return bool
     */
    public static function isGtin($value)
    {
        if (! is_numeric($value)) {
            return false;
        }

        if (! preg_match('/^\d{8}(?:\d{4,6})?$/', $value)) {
            return false;
        }

        return substr($value, 0, -1).collect(str_split($value))
            ->slice(0, -1)
            ->pipe(function ($collection) {
                return $collection->sum() === 0 ? collect(1) : $collection;
            })
            ->reverse()
            ->values()
            ->map(function ($digit, $key) {
                return $key % 2 === 0 ? $digit * 3 : $digit;
            })
            ->pipe(function ($collection) {
                return ceil($collection->sum() / 10) * 10 - $collection->sum();
            }) == $value;
    }
}
