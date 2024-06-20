<?php

use Devsohail\Gtin\Validator as GtinValidator;

if (! function_exists('is_gtin')) {
    /**
     * Determine if a value is valid Global Trade Identification Number.
     *
     * @param  string|int  $value
     * @return bool
     */
    function is_gtin($value): bool
    {
        return GtinValidator::isGtin($value);
    }
}
