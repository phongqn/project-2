<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Rules\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeImgEnum extends Enum
{
    const BANNER_IMG =  'App\Models\Banner';
    const BRAND_IMG =  'App\Models\Brand';
    const PRODUCT_IMG =  'App\Models\Product';
    const PRODUCTSIZE_IMG = 'App\Models\ProductSize';
}
