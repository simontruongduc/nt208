<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use App\Models\Product;
/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductStatusEnum extends Enum
{
    const COMING_SOON =   'coming soon';
    const STOCK =   'stock';
    const OUT_OF_STOCK = 'out of stock';
    public static function getDispValue($value, $type = null): string
    {
        switch ($value){
            case self::COMING_SOON:
                return 'Hàng sắp về';
                break;
            case self::STOCK:
                return 'Còn hàng';
                break;
            case self::OUT_OF_STOCK:
                return 'Hết Hàng';
                break;
            default:
                return self::getKey($value);
        }
    }
}
