<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InformationUser
 *
 * @package App\Models
 */
class InformationUser extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'information_user';

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'information_id'];
}
