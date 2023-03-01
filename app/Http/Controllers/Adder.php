<?php

namespace App\Http\Controllers;

use App\Models\New_location;
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

    public function makeDealer(){
        Dealer::create([
            'title'=> "Мой ДЦ",
            'address' => "Проспект мира, дом кефира",
            'confirmed' => 1,
        ]);
    }

}
