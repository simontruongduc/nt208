<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coupon
 *
 * @package App\Models
 */
class Coupon extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'coupons';

    /**
     * @var string[]
     */
    protected $fillable = ['code', 'status', 'note', 'condition_id'];

    //relationship

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function condition()
    {
        return $this->hasOne(Condition::class);
    }
}
