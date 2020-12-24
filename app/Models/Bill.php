<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Bill
 *
 * @package App\Models
 */
class Bill extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'bills';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'information_id',
        'date_order',
        'date_finish',
        'note',
        'coupon_id',
        'payment',
        'total',
    ];

    //relationship

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function information()
    {
        return $this->hasOne(Information::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bill_detail()
    {
        return $this->hasMany(Bill_detail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function couponUser()
    {
        return $this->belongsTo(CouponUser::class);
    }
}
