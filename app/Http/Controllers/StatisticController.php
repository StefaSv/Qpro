<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    public function sort(Request $request){


        $managers = User::where('dealerId', Auth::user()['dealerId'])->where('is_fired', 0)->get();
        foreach($managers as $manager) {
                $data[] = [
                    $manager['id'],
                    $manager['name'],
                    $manager['surname'],
                    $manager['third_name'],
                    $manager['avatar'],
                    $manager['rating'],
                    Offer::where('managerId', $manager['id'])->get()->count(),
                    Message::where('user_from', $manager['id'])->get()->count(),
                    Offer::where('managerId', $manager['id'])->get()->sum('views'),
                    asset('img/star.svg'),
                ];
        }
        $type_sort = 0;
        if ($request['id'] == "rating") {
            $type_sort = 5;
        }elseif ($request['id'] == "num_adv") {
            $type_sort = 6;
        }elseif ($request['id'] == "num_chat") {
            $type_sort = 7;
        }elseif ($request['id'] == "num_view") {
            $type_sort = 8;
        }

        usort($data, function ($a, $b) use ($type_sort) {
            if ($a[$type_sort] == $b[$type_sort]) {
                return 0;
            }
            return ($a[$type_sort] < $b[$type_sort]) ? -1 : 1;
        });

        return response()->json($data);
    }
}
