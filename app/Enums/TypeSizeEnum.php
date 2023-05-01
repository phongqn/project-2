<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeSizeEnum extends Enum
{
    const CM = 1;
    const M = 2;
    const MM = 3;
    const INCH = 4;
    const KG = 5;
    const L = 6;
    public static function getName($type)
    {
        if ($type == 1) return 'cm';
        else if ($type == 2) return 'm';
        else if ($type == 3) return 'mm';
        else if ($type == 4) return 'inch';
        else if ($type == 5) return 'kg';
        else if ($type == 6) return 'lít';
        else return 'W';
    }
}
