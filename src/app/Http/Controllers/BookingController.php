<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function add(BookingRequest $request)
    {
        $datetime = new DateTime($request->date . " " . $request->time);
        if (Auth::id() == null) {
            return redirect('/login');
        } else {
            Reservation::create([
                'user_id' => Auth::id(),
                'shop_id' => $request->shop_id,
                'reservation_time' => $datetime,
                'number' => $request->number
            ]);
            // return redirect()->route('detail', ['shop_id' => $request->shop_id]);
            return view("bookingThanks");
        }
        ;

    }

    public function delete(Request $request)
    {
        $post = Reservation::find($request->id);
        $post->delete();
        return redirect('mypage');
    }

    public function change(BookingRequest $request)
    {
        $datetime = new DateTime($request->date . " " . $request->time);

        Reservation::where('id', $request->id)->update([
            'reservation_time' => $datetime,
            'number' => $request->number
        ]);

        return view('bookingChangeThanks');
    }

    public function review(Request $request)
    {
        $review = 0;
        for ($i = 1; $i < 6; $i++) {
            $reviewNum = "review" . $i;
            $review = $review + $request->$reviewNum;
        }

        Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $request->id,
            'review' => $review
        ]);

        $post = Reservation::find($request->id);
        $post->delete();

        return view('reviewThanks');
    }

    public function manager()
    {
        $shops = Shop::where('registered_id', Auth::id())->has('Reservation')->with('Reservation')->get();

        // foreach($reservations as $reservation){
        //     foreach($reservation->Reservation as $reserve){
        //         dd($reserve->shop_id);
        //     }
        // }

        return view('bookingList', compact('shops'));
    }

    public function detail($booking_id)
    {
        $booking = Reservation::where('id', $booking_id)->with('user', 'shop')->first();

        return view('bookingDetail', compact('booking'));
    }
}