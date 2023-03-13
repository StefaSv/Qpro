<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Pay_account;
use App\Models\ProfileChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileDCCintroller extends Controller
{

    public function set(Request $request){
        DB::table('dealer')->
            where('id','=',Auth::user()['dealerId'])->
            update([
                'title' => $request['name_dc'],
                'address' => $request['address_dc'],
                'full_name' => $request['full_name'],
                'phone_center' => $request['center_tel'],
                'yor_adress' => $request['yur_address'],
                'post_adress' => $request['post_address'],
                'type' => $request['org_type'],
                'inn' => $request['inn'],
                'kpp' => $request['kpp'],
                'okpo' => $request['okpo'],
                'okato' => $request['okato'],
                'bik' => $request['bik'],
                'ogrn' => $request['ogrn'],
                'email_dc' => $request['mail_dc'],
                'site_dc' => $request['site_dc'],
                'name_director' => $request['name_dir'],
        ]);
        return redirect('/profile-DC/full');
    }

    public function sendRequest(Request $request){
        ProfileChange::create(
            [
                'dealer_id' => Auth::user()['dealerId'],
                'message' => $request['message'],
            ]
        );
        return redirect()->back();
    }

}
