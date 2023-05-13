<?php

namespace Clouds\Utils\Math;

class Pythagoras
{
    public static function getNumberDecimalPlaces(float $number): int
    {
        return strlen(substr($number, strpos($number,  ".") + 1));
    }

    public static function getRemainder(int|float $number): int
    {
        $multiplied_number = $number * (10 * self::getNumberDecimalPlaces($number));

        return $multiplied_number % 2;
    }
}