<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PayMentMethodEnum extends Enum
{
    const DIRECT = 1;
    const VNPAY = 2;
    public static function getName($type)
    {
        if ($type == 1) return 'Thanh toán khi nhận';
        else return 'Thanh toán online';
    }
}
