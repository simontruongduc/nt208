<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdminMessage
 *
 * @package App\Models
 */
class AdminMessage extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'admin_message';

    /**
     * @var string[]
     */
    protected $fillable = ['admin_id', 'message_id'];
}
