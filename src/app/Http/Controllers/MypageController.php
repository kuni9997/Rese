<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index(){

        $bookings = Reservation::with(['shop'])->where('user_id',Auth::id())->get();
        $favorites = Favorite::with(['shop'])->where('user_id', Auth::id())->get();

        return view('mypage',compact('bookings','favorites'));
    }
}