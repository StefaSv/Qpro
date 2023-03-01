<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Frozen;

class AdvertisementController extends Controller
{
    public function sendChange(Request $request, $id){
        $text = $request['desc'];
        //dd($text);
        Frozen::create([
            'id_offer' => $id,
            'text' => $text,
        ]);
        return redirect()->back();
    }

    public function froze(Request $request, $id){
        DB::table('offers')
            ->where('id', '=',$id)
            ->update(
                ['is_frozen' => 1]
            );
        Frozen::create(
            [
                'id_offer' => $id,
                'text' => $request['desc'],
            ]
        );
        return redirect()->back();
    }

    public function unfroze($id){
        DB::table('offers')
            ->where('id', '=',$id)
            ->update(
                ['is_frozen' => 0]
            );
        DB::table('offer_frozen')
            ->delete($id);
        return redirect()->back();
    }
}
