<?php

namespace App\Http\Controllers;

use App\Models\Offer_frozen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Frozen;

class AdvertisementController extends Controller
{
    public function sendChange(Request $request){
        Offer_frozen::create([
            'offer_id' => $request['offer_id'],
            'frozen_or_change' => 'change',
            'text' => $request['text'],
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function froze(Request $request){
        DB::table('offers')
            ->where('id', '=',$request['offer_id'])
            ->update(
                ['is_frozen' => 1]
            );
        Offer_frozen::create(
            [
                'offer_id' => $request['offer_id'],
                'frozen_or_change' => "frozen",
                'text' => $request['text'],
            ]
        );
        return response()->json([
            'success' => true,
            'type' => $request['type_send'],
        ]);
    }

    public function unfroze(Request $request){

        DB::table('offers')
            ->where('id', '=',$request['offer_id'])
            ->update(
                ['is_frozen' => 0]
            );
        return response()->json([
            'success' => true,
            'id' => $request['offer_id'],
            'type' => $request['type_send'],
        ]);
    }
}
