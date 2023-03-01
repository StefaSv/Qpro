<?php

namespace App\Http\Controllers;

use App\Mail\RecoverPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Unisender\ApiWrapper\UnisenderApi as Unisender;
use Log;


class RecController extends Controller
{

    public function checklogin(Request $request){

        $user = User::where('email', $request['email'])->first();
        if ($user == null) {
            return redirect('/login/recovery');
        } else {
            $data = 2222;

            $res = $this->sendEmail("stefansvetlichniy@gmail.com", "message_pass", $data, "123");

            dd($res);
        }

    }
    public function sendEmail($email, $view, $data, $subject) {

        $body = view($view)->with([
            'data' => $data
        ])->render();
        $sender = new Unisender(env('API_EMAIL_KEY'));

        $res = $sender->sendEmail([
            'email' => $email,
            'sender_name' => 'Carsseller',
            'sender_email' => 'info@carsseller.ru',
            'subject' => $subject,
            'body' => $body,
            'list_id' => 1
        ]);
        dd($res);
        if(isset(json_decode($res)->result->email_id)) {
            return true;
        } else {
            Log::info($res);
        }
    }
}
