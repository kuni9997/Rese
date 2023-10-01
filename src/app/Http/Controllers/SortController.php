<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SortController extends Controller
{
    public function sort(Request $request)
    {
        $areas = Shop::select('area')->distinct()->get();
        $genres = Shop::select('genre')->distinct()->get();
        $shops = Shop::all();
        $favorites = Favorite::where('user_id', Auth::id())->get();

        // dd($shops);

        //並び替え機能
        //ランダム
        if ($request->form_sort == "rand") {
            $shops = $shops->shuffle();
        }elseif($request->form_sort == "high"){
            $shops_1 = DB::table('shops')
                ->select(
                    'shops.id',
                    'shops.registered_id',
                    'shops.shop_name',
                    'shops.area',
                    'shops.genre',
                    'shops.shop_desc',
                    'shops.pic_url',
                    'reviews.id as review_id',
                    'reviews.review'
                )
                ->join('reviews', 'shops.id', '=', 'reviews.shop_id')
                ->get();
            $shops_2 = shop::doesntHave('review')
                ->get()
                ->map(function ($v) {
                    $v['review'] = 0;
                    return $v;
                });
            
            $shops = collect($shops_1)->merge($shops_2)->unique('id');
            dd($shops = $shops->sortBy('review'));
        }
        return view('home', compact('areas', 'genres', 'shops', 'favorites'));
    }
}