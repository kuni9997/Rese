<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Shop;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index() {

        $areas = Shop::select('area')->distinct()->get();
        $genres = Shop::select('genre')->distinct()->get();
        $shops = Shop::all();
        $favorites = Favorite::where('user_id', Auth::id())->get();

        return view('home',compact('areas','genres','shops','favorites'));
    }

    public function detail($shop_id) {
        $shop_detail = Shop::where('id', $shop_id)->first();
        $user = User::where('id', Auth::id())->first();
        $reviews = Review::with('reviewPost')->where('shop_id',$shop_id)->get();
        $reviewExists = Review::where('shop_id', $shop_id)->where('user_id', Auth::id())->doesntExist();

        dd($shop_id);

        return view('shopDetail', compact('shop_detail','shop_id','user','reviews','reviewExists'));
    }

}
