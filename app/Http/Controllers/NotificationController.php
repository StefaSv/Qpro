<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function read(Request $request){
        if ($request['id'] == "all"){
            DB::table('notifications')
                ->where('userId','=',$request['user_id'])
                ->update(['read' => 1]);
        }

        DB::table('notifications')
            ->where('id','=',$request['id'])
            ->update(['read' => 1]);
    }
}
