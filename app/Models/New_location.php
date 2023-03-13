<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_location extends Model
{
    use HasFactory;

    protected $table='location';

    protected $fillable = [
        'id',
        'title',

    ];
}
