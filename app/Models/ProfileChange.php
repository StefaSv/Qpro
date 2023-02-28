<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileChange extends Model
{
    use HasFactory;

    protected $table = 'change_dc_request';

    protected $fillable = [
        'dealer_id',
        'message',
    ];
}
