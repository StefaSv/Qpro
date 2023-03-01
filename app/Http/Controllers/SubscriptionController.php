<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Offer;
use App\Models\Pay_account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function payAccount(Request $request){
        $request['days'] = str_replace(" дней","",$request['days']);
        Pay_account::create([
            'dealerId' => Auth::user()['dealerId'],
            'days' => $request['days'],
            'date_start' => date('d M Y',strtotime('now')),
            'date_over' => date('d M Y',strtotime("+".$request['days']."days", strtotime('now'))),
            'summ' => 30000,
        ]);
        return redirect('/profile-DC/full');
    }

    public function composeCheck($id){
        return redirect()->back();
    }

    public function checkSub(){
        $dealer = Dealer::find(Auth::user()['dealerId']);
        $subscription = Pay_account::where('dealerId', $dealer['id'])->where('is_payd',1)->where('is_start',1)->where('is_over',0)->first();
        if ($subscription != null) {
            $data = strtotime($subscription['date_over']) - strtotime('now');
            if ($data < 0) {
                DB::table('pay_accounts')
                    ->where('dealerId', $dealer['id'])->where('is_payd', 1)->where('is_start', 1)->where('is_over', 0)
                    ->update(['is_over' => 1]);
                $users = User::where('dealerId', $dealer['id'])->get();
                $users->map(function ($user) {
                    $offers = Offer::where('managerId', $user['id'])->get();
                    $num_offers = $offers->count();
                    if ($num_offers > 1) {
                        for ($i = 0; $i < $num_offers; $i++) {
                            DB::table('offers')
                                ->where('id', '=', $offers[$i]['id'])
                                ->update(['is_frozen' => 1]);
                        }
                    }
                });
            }
            return response()->json(['data' => 0]);
        }
        return response()->json(['data' => 0]);
    }
}
