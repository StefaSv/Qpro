<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class AuthenticationController extends Controller
{


        public function login(Request $request){
            $request = $request->only(['login', 'password']);
            $login_user = User::where('email',$request['login'])->where('role','director')->first();
          //  dd($login_user);

            if(is_null($login_user)){
                //dd(1);
                return redirect()->back();
            }

            if (Hash::check($request['password'],$login_user['password'])){
                //dd(2);
                Auth::login($login_user);

               // if(Dealer::find(Auth::user()['dealerId'])['confirmed'] == 0){
               //     return redirect('/registration/completed');
               // }
                if(is_null(Dealer::find(Auth::user()['dealerId'])['full_name'])){
                    //dd(3);
                    return redirect('/profile-DC');
                }else{
                    //dd(4);
                    return redirect('/profile-DC/full');
                }


            }else{
                //dd(5);
                return redirect()->back();
//                    response()->json([
//                    'success' => false,
//                    'message' => "Неверный пароль"
//                ]);
            }
        }



        public function logout(){
            Auth::logout();
            return redirect('/');
        }

}
