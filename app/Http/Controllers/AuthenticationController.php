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
            $login_user = User::where('email',$request['login'])->first();

            if(is_null($login_user)){
                return redirect()->back();
            }

            if (Hash::check($request['password'],$login_user['password'])){
                Auth::attempt([
                    'email' => $request['login'],
                    'password' => $request['password'],
                ]);

               // if(Dealer::find(Auth::user()['dealerId'])['confirmed'] == 0){
               //     return redirect('/registration/completed');
               // }
                if(is_null(Dealer::find(Auth::user()['dealerId'])['full_name'])){
                    return redirect('/profile-DC');
                }else{
                    return redirect('/profile-DC/full');
                }


            }else{
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
