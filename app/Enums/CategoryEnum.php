<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class CategoryEnum extends Enum
{

    public const CHARGING_CABLE = 'charging cable';
    public const RECHARGEABLE_BATTERY_BACKUP = 'rechargeable battery backup';
    public const HEADPHONE = 'headphone';
    public const CASE = 'case';
    public const SPEAKER = 'speaker';
    public const STORAGE_DEVICE = 'storage_device';
    public const KEYBOARD ='keyboard';
    public const TEMPERED_GLASS = 'tempered glass';
    public const OTHER = 'other';

    public static function getDispValue($value, $type = null): string
    {
        switch ($value){
            case self::CHARGING_CABLE:
                return 'Sạc cáp';
                break;
            case self::RECHARGEABLE_BATTERY_BACKUP:
                return 'Pin dự phòng';
                break;
            case self::HEADPHONE:
                return 'Tai nghe';
                break;
            case self::CASE:
                return 'Bao da / Ốp lưng';
                break;
            case self::TEMPERED_GLASS:
                return 'Kính cường lực';
                break;
            case self::KEYBOARD:
                return 'Bàn phím';
                break;
            case self::SPEAKER:
                return 'Loa';
                break;
            case self::STORAGE_DEVICE:
                return 'Thiết bị lưu trữ';
                break;
            case self::OTHER:
                return 'Phụ kiện khác';
                break;
            default:
                return self::getKey($value);
        }
    }
}
