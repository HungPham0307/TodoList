<?php

namespace App\Enums;

final class WorkStatus extends Enums
{
    const PLANNING = 1;
    const DOING = 2;
    const COMPLETE = 3;

    const TOTAL_STATUS = 3;

    public static function getName($value)
    {
        switch ($value) {
            case self::PLANNING:
                return 'planning';
                break;
            case self::DOING:
                return 'doing';
                break;
            case self::COMPLETE:
                return 'complete';
                break;
            default:
                return 'No name';
                break;
        }
    }
}
