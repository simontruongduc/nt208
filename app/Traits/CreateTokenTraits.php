<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Hash;

/**
 * Trait CreateTokenTraits
 *
 * @package App\Traits
 */
trait CreateTokenTraits
{
    /**
     * @param int $length
     * @return string
     */
    function generateRandomToken($length = 15)
    {
        $characters = '*!@#$%&123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return md5($randomString);
    }
}
