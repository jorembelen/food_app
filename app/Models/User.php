<?php

namespace App\Models;

use App\Traits\ProductTraits;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ProductTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $incrementing = false;

    protected $fillable = [
        'f_name',
        'l_name',
        'mobile_number',
        'address',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        User::creating(function ($model) {
            $model->setId();
        });
    }

    public function setId()
    {
        $this->attributes['id'] = Str::uuid();
    }

    public function getFullname()
    {
        return $this->f_name . ' ' . $this->l_name;
    }

    public function isAdmin()
    {
        return $this->role_id == 1;
    }

}
