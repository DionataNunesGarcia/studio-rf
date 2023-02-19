<?php

namespace App\Utils\Enum;

class YesNoEnum
{
    /**
     * @return string[]
     */
    public static function getArray() :array
    {
        return [
            1 => 'Sim',
            0 => 'Não',
        ];
    }

    /**
     * @param int|null $type
     * @return string
     */
    public static function getType(?int $type) :string
    {
        $type = $type ? 1 : 0;
        return self::getArray()[$type];
    }
}
