<?php

namespace App\Utils\Enum;

class DaysOfWeek
{
    const SUNDAY = 0;
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;

    public static function getArray()
    {
        return [
            self::MONDAY => 'Segunda-feira',
            self::TUESDAY => 'Terça-feira',
            self::WEDNESDAY => 'Quarta-feira',
            self::THURSDAY => 'Quinta-feira',
            self::FRIDAY => 'Sexta-feira',
            self::SATURDAY => 'Sabádo',
            self::SUNDAY => 'Domingo',
        ];
    }

    /**
     * @param string $type
     * @return string
     */
    public static function getType(string $type) :string
    {
        return self::getArray()[$type];
    }
}
