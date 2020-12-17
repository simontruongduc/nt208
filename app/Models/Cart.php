<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Cart
 *
 * @package App\Models
 */
class Cart extends UuidModel
{
    use SoftDeletes;

    protected $product;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'carts';

    /**
     * @var string[]
     */
    protected $fillable = ['user_id'];

    //relationship

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Cart::class)->withPivot('qty');
    }

    /**
     * @return float|int
     */
    public function getTotal()
    {
        $this->product = new Product();
        $cart = Cart::query()->where('user_id', Auth::id())->first();
        $cartProduct = CartProduct::query()->where('cart_id', $cart->id)->get();
        $total = 0;
        foreach ($cartProduct as $product) {
            $total += $product->qty * $this->product->getProductPrice($product->product_id);
        }

        return $total;
    }
}
