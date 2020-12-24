<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CouponStatusEnum extends Enum
{
    const STOCK = '1';

    const OUT_OF_STOCK = '0';

    public static function getDispValue($value, $type = null): string
    {
        switch ($value) {
            case self::STOCK:
                return 'Còn';
                break;
            case self::OUT_OF_STOCK:
                return 'Đã hết';
                break;
            default:
                return self::getKey($value);
        }
    }
}
