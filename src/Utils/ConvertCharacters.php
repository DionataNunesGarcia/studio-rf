<?php

namespace App\Utils;

class ConvertCharacters
{
    /**
     * @param string $value
     * @return string|null
     */
    public static function onlyNumbers(string $value) :?string
    {
        if (empty($value)) {
            return null;
        }
        return preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * @param string $value
     * @return float|null
     */
    public static function stringToFloat(string $value) :?float
    {
        if (empty($value)) {
            return 0;
        }
        if (strstr($value, ",")) {
            $value = str_replace(".", "", $value); // replace dots (thousand seps) with blancs
            $value = str_replace(",", ".", $value); // replace ',' with '.'
        }
        // search for number that may contain '.'
        if (preg_match("#([0-9\.]+)#", $value, $match)) {
            return floatval($match[0]);
        }
        // take some last chances with floatval
        return floatval($value);
    }

    /**
     * @param ?float $value
     * @param int $decimals
     * @return string|null
     */
    public static function floatToString(?float $value, int $decimals = 2) :?string
    {
        if (empty($value)) {
            return '0';
        }
        return number_format($value, $decimals, ',', '.');
    }

    /**
     * @param float $value
     * @param int $decimals
     * @param string $symbol
     * @return string|null
     */
    public static function floatToStringEncrypted(float $value, int $decimals = 2, string $symbol = 'R$') :?string
    {
        if (empty($value)) {
            return "{$symbol} 0,00";
        }
        return "{$symbol} " . self::floatToString($value, $decimals);
    }
}
