<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'message';

    protected $fillable = [
        'id',
        'room_id',
        'ip',
        'user_from',
        'message',
        'created_at',
        'file',
    ];
}
