<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Province
 *
 * @package App\Models
 */
class Province extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'provinces';

    /**
     * @var string[]
     */
    protected $fillable = ['name'];

    //relationship

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function informations()
    {
        return $this->hasMany(Information::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
