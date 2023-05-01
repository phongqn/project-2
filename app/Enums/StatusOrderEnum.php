<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusOrderEnum extends Enum
{
    const PROCESSING = 1;
    const TRANSPORT = 2;
    const RECEIVED = 3;
    const CANCELED = 4;
    public static function getName($type)
    {
        if ($type == 1) return 'Đang xử lý';
        else if ($type == 2) return 'Đang vận chuyển';
        else if ($type == 3) return 'Đã nhận';
        else return 'Đã hủy';
    }
}
