<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_model extends Model
{
    use HasFactory;

    protected $table = 'model';

    protected $fillable=[
        'id',
        ''
    ];

}
