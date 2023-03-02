<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wait_change_profile_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'phone',
        'email',
    ];
}
