<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    public function getMessages(){
        $data = []; 
        $chat = Chat::where('user_id', Auth::id())->first();
        if ($chat == null){
            return response();
        }
        $rooms = Room::where('chat_id', $chat['id'])->get();
        foreach ($rooms as $room){
            $messages = Message::where('room_id', $room['id'])->get();
            foreach ($messages as $message){
                $data[]  = [$message['user_from'], $message['message'], date('h:i',strtotime($message['created_at'])), $message['file']];
            }
            if($room['is_active'] == 0) {
                $data[] = "break";
            }
        }
        return response()->json($data);
    }

    public function sendMessage(Request $request){
        $path = null;
        $chat = Chat::where('user_id', Auth::id())->first();
        if ($chat != null) {
            $active_room = Room::where('chat_id', $chat['id'])->where('is_active', 1)->first();
        }
        if($request->hasFile('file-0')){
            $path = "/storage/".$request->file('file-0')->store('uploads', 'public');
            $path = str_replace('/storage', '/storage/app/public', $path);
        }elseif ($request['message'] == null){
            return response();
        }
        if ($chat == null){
            $new_chat = Chat::create(
                [
                    'user_id' => Auth::id(),
                ]
            );
            $new_room = Room::create(
                [
                    'chat_id' => $new_chat['id'],
                    'user_id' => Auth::id(),
                ]
            );
            $message = Message::create(
                [
                    'room_id' => $new_room['id'],
                    'user_from' => Auth::id(),
                    'message' => $request['message'],
                    'ip' => '0.0.0.0',
                    'file' => $path,
                ]
            );
        } elseif ($active_room == null){
            $new_room = Room::create(
                [
                    'chat_id' => $chat['id'],
                    'user_id' => Auth::id(),
                ]
            );
            $message = Message::create(
                [
                    'room_id' => $new_room['id'],
                    'user_from' => Auth::id(),
                    'message' => $request['message'],
                    'ip' => '0.0.0.0',
                    'file' => $path,
                ]
            );
        }else{
            $message = Message::create(
                [
                    'room_id' => $active_room['id'],
                    'user_from' => Auth::id(),
                    'message' => $request['message'],
                    'ip' => '0.0.0.0',
                    'file' => $path,
                ]
            );
        }
       // dd($_FILES['file-0']);
       // dd($request->hasFile('file-0'));

        $data  = $message->only(['message', 'created_at', 'file']);
        $data['created_at'] = date('h:i', strtotime($data['created_at']));
        $data = array_values($data);
        return response()->json($data);
    }

    public function checkNew(){
        $data = [];
        $chat = Chat::where('user_id', Auth::id())->first();
        if ($chat != null) {
            $room = Room::where('chat_id', $chat['id'])->where('is_active', 1)->first();
        }
        $messages = Message::where('room_id', $room['id'])->where('is_show', 0)->where('user_from','=', 1)->get();
        DB::table('message')
            ->where('room_id', $room['id'])->where('is_show', 0)->where('user_from','!=', Auth::id())
            ->update(['is_show' => 1]);
        foreach ($messages as $message){
            $data[] = [$message['message'],date('h:i', strtotime($message['created_at']))] ;
        }
        return response()->json($data);
    }
}
