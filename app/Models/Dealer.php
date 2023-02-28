<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'brand',
        'locationId',
        'address',
        'lat',
        'created_at',
        'updated_at',
        'email',
    ];
}
