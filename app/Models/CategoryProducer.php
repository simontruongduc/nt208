<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CategoryProducer
 *
 * @package App\Models
 */
class CategoryProducer extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'category_producer';

    /**
     * @var string[]
     */
    protected $fillable = ['category_id', 'producer_id'];
}
