<?php

namespace App\Models;

/**
 * Class CartProduct
 *
 * @package App\Models
 */
class CartProduct extends UuidModel
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'cart_product';

    /**
     * @var string[]
     */
    protected $fillable = ['cart_id', 'product_id','qty'];
}
