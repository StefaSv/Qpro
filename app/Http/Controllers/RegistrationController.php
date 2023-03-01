<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Dealer;
use App\Models\New_location;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SmsApi;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{

    public function set(Request $request){
        $double_user = User::where('email', $request['email'])->first();
        if ($double_user == null) {
            $double_user = User::where('phone', $request['phone'])->first();
            if ($double_user == null) {
                $sms = new SmsApi();
                $phone = str_replace("+", "", $request['phone']);
                $return = $sms->sendCallTel($phone);
                $pincode = $return->callDetails->pin;
                $user = User::create([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'third_name' => $request['last_name'],
                    'password' => Hash::make($request['password']),
                    'sms' => $pincode,
                ]);
                Auth::attempt([
                    'email' => $request['email'],
                    'password' => $request['password'],
                ]);
                return response()->json([
                    'success' => 'true'
                ]);
            }else{
                return response()->json([
                    'success' => 'false',
                    'error' => 'phone_registered'
                ]);
            }
        }else{
            return response()->json([
                'success' => 'false',
                'error' => 'email_registered'
            ]);
        }
    }

    public function setDealers(Request $request){
        $dealers = \App\Models\Dealer::where('locationId','=', $request['loc_id'])->get();
        $data = array();
        foreach ($dealers as $dealer){
            $brands = unserialize($dealer['brand']);
            if (gettype($brands) != 'boolean'){
                foreach ($brands as $brand){
                    if ($brand == $request['brand_id']){
                        $data[$dealer['id']]= ['id' => $dealer['id'], 'text' => $dealer['title']];
                        continue;
                    }
                }
            }else{
                if ($brands == $request['brand_id']){
                    $data[$dealer['id']] = ['id' => $dealer['id'], 'text' => $dealer['title']];
                }
            }
        }
        $data = array_values($data);
        return response()->json($data);
    }

    public function checkPhone (Request $request){
        if(Auth::user()['sms'] == $request['pincode']){
            return redirect('/registration/choice-DC');
        }else{
            DB::table('user')->find(Auth::id())->delete();
            Auth::logout();
        }
        return view('registration.registration',);
    }


    public function registrationCheck(Request $request){
        $dealer = Dealer::find($request['center']);
        DB::table('user')
            ->where('id','=',Auth::id())
            ->update(['dealerId' => $dealer['id']]);
        //if($dealer['confirmed'] == 0){
        //    return redirect('/registration/completed');
        //}
        if(Auth::user()['confirmed'] == 1) {
            if (is_null($dealer['full_name'])) {
                return redirect('/profile-DC');
            } else {
                return redirect('/profile-DC/full');
            }
        }else{
            return redirect('registration/accepted');
        }
    }

    public function setDC(Request $request){
        $dealer = Dealer::create([
            'title' => $request['name'],
            'locationId' => New_location::where('title',$request['region'])->first()['id'],
            'brand' => serialize([0 => Brand::where('title',$request['brand'])->first()['id']]),
            'email' => $request['email'],
        ]);
        DB::table('user')
            ->where('id','=',Auth::id())
            ->update(['dealerId' => $dealer['id']]);

        if(Auth::user()['confirmed'] == 1) {
            if(is_null($dealer['full_name'])) {
                return redirect('/profile-DC');
            }else{
                return redirect('/profile-DC/full');
            }
        }else{
            return redirect('registration/accepted');
        }
    }



}
