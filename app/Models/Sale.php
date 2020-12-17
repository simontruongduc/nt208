<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sale
 *
 * @package App\Models
 */
class Sale extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'sales';

    /**
     * @var string[]
     */
    protected $fillable = ['product_id', 'sale', 'qty', 'date_start', 'date_finish', 'note', 'intro'];

    //relationship

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
