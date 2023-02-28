<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frozen extends Model
{
    use HasFactory;

    protected $table = ['offer_frozen'];

    protected $fillable = [
        'id_offer',
        'text',
    ];
}
