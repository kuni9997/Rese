<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function create(Request $request){
        $user_id = $request->user_id;
        $shop_id = $request->shop_id;

        if (Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->doesntExist()) {
            Favorite::create([
                'user_id' => $user_id,
                'shop_id' => $shop_id
            ]);

        } else {
            Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->delete();
        }

        return redirect()->back();
    }
}