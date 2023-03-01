<?php

namespace App\Http\Controllers;

use App\Models\Frozen;
use App\Models\New_location;
use App\Models\Offer_frozen;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dealer;
use Illuminate\Support\Facades\Hash;


class Adder extends Controller
{
    public function makeUser(){
        User::create([
            'name' => "Стефан",
            'surname' => "Сетличный",
            'dealerId' => 37,
            'email' => "stefansvetlichniy@gmail.com",
            'password' => Hash::make("QAZ43zaq"),
        ]);
    }

    public function makeFrozen(){
        Offer_frozen::create([
            'offer_id' => 1,
            'frozen_or_change' => 'change',
            'text' => "wertgvcd"
        ]);
    }

    public function makeDealer(){
        Dealer::create([
            'title'=> "Мой ДЦ",
            'address' => "Проспект мира, дом кефира",
            'confirmed' => 1,
        ]);
    }

}
