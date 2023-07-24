<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index() {

        $areas = Shop::select('area')->distinct()->get();
        $genres = Shop::select('genre')->distinct()->get();
        $shops = Shop::all();

        // dd($area);

        return view('home',compact('areas','genres','shops'));
    }

    public function detail($shop_id) {
        $shop_detail = Shop::where('id', $shop_id)->first();
        
        return view('shopDetail', compact('shop_detail','shop_id'));
    }

}
