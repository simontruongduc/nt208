<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Webpatser\Uuid\Uuid;

/**
 * Class Admin
 *
 * @package App\Models
 */
class Admin extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'admins';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'password', 'verify_token', 'remember_token', 'note'];
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
    //relationship

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
