<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Option;
use App\Models\Parameter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function showOffer($id){
        $functions = [];
        $offer = Offer::find($id);
        $options = unserialize($offer['options']);
        foreach ($options as $option){
            $parameter = Parameter::find($option);
                $functions[Option::find($parameter['optionId'])['title']][] = $option;
        }
        $functions['offer_id'] = $id;
        return view('sales.offer',[
            'winter_package'=> $functions['Зимний пакет'],
            'lights' => $functions['Фары'],
            'num_seats' => $functions['Количество мест'],
            'comfort' => $functions['Комфорт'],
            'multimedia' => $functions['Мультимедиа'],
            'salon' => $functions['Салон'],
            'offer_id' => $id,
        ]);
    }

    public function showProfileManager($id){
        return view('sales.profile_manager', ['id' => $id]);
    }

    public function userFire($id){
        DB::table('users')
            ->where('id','=',$id)
            ->update(['is_fired' => 1]);
        return redirect()->back();
    }

    public function userNotConfirm($id){
        DB::table('users')
            ->where('id','=',$id)
            ->update(['is_fired' => 1]);
        return redirect()->back();
    }

    public function userConfirm($id){
        DB::table('users')
            ->where('id','=',$id)
            ->update(['confirmed' => 1]);
        return redirect()->back();
    }

}
