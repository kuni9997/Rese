<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class SearchController extends Controller
{
    public function search(Request $request) {
        $request->flash();

        $areas = Shop::select('area')->distinct()->get();
        $genres = Shop::select('genre')->distinct()->get();

        $area = $request->form_area;
        $genre = $request->form_genre;
        $shop_name = $request->form_search;

        $shops = Shop::select()
            ->whereAreas($area)
            ->whereGenres($genre)
            ->whereShopsName($shop_name)
            ->get();

        return view('home', compact('areas', 'genres', 'shops'));

    }
}