<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 *
 * @package App\Models
 */
class Message extends UuidModel
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * @var string[]
     */
    protected $fillable = ['email', 'name', 'message', 'status', 'reply'];

    //relationship

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }
}
