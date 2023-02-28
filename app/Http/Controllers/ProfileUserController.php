<?php

namespace App\Http\Controllers;

use App\Models\Wait_change_profile_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileUserController extends Controller
{

    public function set(Request $request){
        $db = DB::table('user')
            ->where('id','=',Auth::id());
            if (is_null($request['third_name']) | is_null($request['third_name'])){
                return redirect()->back(); //ошибку написать
            }
            $db->update(['name' => $request['first_name']]);
            $db->update(['surname' => $request['last_name']]);
        if(!is_null($request['third_name'])){
            $db->update(['third_name' => $request['third_name']]);
        }
        if($request->hasFile('avatar_file')){
            $path = "/storage/".$request->file('avatar_file')->store('uploads', 'public');
            DB::table('user')
                ->where('id','=',Auth::id())
                ->update(['avatar' => $path]);
            return redirect('/profile-data');
        }
        return redirect('/profile-data');
    }

    public function passwordChange(Request $request){

        if (Hash::check($request['old_password'],Auth::user()['password'])){
            if($request['new_password'] == $request['repeat_new_password']){
                DB::table('user')
                    ->where('id','=',Auth::id())
                    ->update([
                        'password' => Hash::make($request['new_password'])
                    ]);
                return redirect('/profile-data');
            }else{
                return redirect('/profile-data');
            }
        }else{
            return redirect('/profile-data');
        }
    }

    public function phoneMaleChange(Request $request){
        Wait_change_profile_user::create([
            'user_id' => Auth::id(),
            'phone' => !is_null($request['phone']),
            'email' => !is_null($request['email']),
        ]);
    }

}
