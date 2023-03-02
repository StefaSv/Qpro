<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer_frozen extends Model
{
    use HasFactory;

    protected $table = 'offer_frozen';

    protected $fillable = ['offer_id', 'frozen_or_change', 'text'];

}