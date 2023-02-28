<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        "equipment",
        "brand",
        "model",
        "body",
        "transmission",
        "drive",
        "engine",
        "typeengine",
        "volume",
        "power",
        "racing",
        "consumption",
        "clearance",
        "color",
        "options",
        "pts",
        "tradeIn",
        "credit",
        "salon",
        "cost",
        "costInfo",
        "priceTradeInFrom",
        "priceTradeInTo",
        "priceTradeInInfo",
        "priceCreditFrom",
        "priceCreditTo",
        "priceCreditInfo",
        "img",
        "vin",
        "preview",
        "banned",
        "created_at",
        "updated_at",
        "deleted_at",
        "views",
        "used",
        "auto_state_id",
        "pts_person_num",
        "mileage",
        "video",
        "power_reserve",
    ];
}
