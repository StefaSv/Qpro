<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay_account extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'dealerId',
        'days',
        'pay_type',
        'summ',
        'is_payd',
        'date_start',
        'date_over',
    ];
}
