<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @package App\Models
 */
class Product extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'price', 'category_id', 'qty', 'intro', 'note'];

    #region [Relationship]

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producer()
    {
        return $this->belongsTo(Producer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function introduce()
    {
        return $this->hasOne(Introduce::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('qty');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function route()
    {
        return $this->hasOne(Route::class);
    }

    public function cart()
    {
        return $this->hasOne(CartProduct::class);
    }
    #endregion

    /**
     * @param $product
     * @return mixed
     */
    public function getSalePrice(Product $product)
    {
        $today = Carbon::now();
        $sale = $product->sales()
                        ->where('sales.date_start', '<=', $today)
                        ->where('sales.date_finish', '>=', $today)->first();
        if ($sale) {
            return $product->price - $product->price * $sale->sale;
        }

        return null;
    }

    /**
     * @param $id
     * @return false|float
     */
    public function getTotalRate($id)
    {
        $rate = Rate::query()->where('product_id', $id)->pluck('rate')->toArray();

        return round(array_sum($rate) / count($rate), 1, PHP_ROUND_HALF_DOWN);;
    }

    /**
     * @param $id
     * @param $rate
     * @return mixed
     */
    public function getRate($id, $rate)
    {
        return Rate::query()->where('product_id', $id)->where('rate', $rate)->count();
    }
}
