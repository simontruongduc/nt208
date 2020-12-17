<?php

namespace App\Models;

use App\Traits\UploadImageTrait;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

/**
 * Class UuidModel
 *
 * @package App\Models
 */
class UuidModel extends Model
{
    use UploadImageTrait;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     *
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->{$model->getKeyName()} = Uuid::generate(4);

        });
    }
}
