<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Condition
 *
 * @package App\Models
 */
class Condition extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'conditions';

    /**
     * @var string[]
     */
    protected $fillable = ['discount', 'maximum', 'minimum', 'rule', 'message', 'user_id'];

    //relationship

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupon()
    {
        return $this->hasMany(Coupon::class);
    }
}
