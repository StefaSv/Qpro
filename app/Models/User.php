<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    protected $table = 'users';

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'dealerId',
        'name',
        'surname',
        'role',
        'avatar',
        'online',
        'socket',
        'phone',
        'sms',
        'email',
        'password',
        'active',
        'brand',
        'pushNewOffer',
        'pushNewMessage',
        'pushVIN',
        'address',
        'remember_token',
        'email_verified_at',
        'tokenId',
        'created_at',
        'updated_at',
        'device_type',
        'seller_types_id',
        'Индекс',
        'confirmed',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
