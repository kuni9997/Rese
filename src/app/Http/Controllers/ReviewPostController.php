<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Review;
use App\Models\ReviewPost;
use Illuminate\Support\Facades\Storage;

class ReviewPostController extends Controller
{
    public function index(Request $request)
    {
        $shop = Shop::where('id',$request->shop_id)->first();
        $review = Review::with('reviewPost')->where('user_id', Auth::id())->where('shop_id', $request->shop_id)->first();

        //既に口コミの投稿があった場合
        if($review <> null){
            $request->session()->put([
                '_old_input' => [
                    'text' => $review->reviewPost->review_text,
                    'image' => $review->reviewPost->review_pic
                ]
            ]);
        }

        return view('reviewPost', compact('shop','review'));
    }

    public function addReview(Request $request)
    {
        $review = 0;
        for ($i = 1; $i < 6; $i++) {
            $reviewNum = "review" . $i;
            $review = $review + $request->$reviewNum;
        }
        Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $request->shop_id,
            'review' => $review
        ]);

        $review_id = Review::where('user_id', Auth::id())->where('shop_id',$request->shop_id)->first('id');
        $fileName = $request->file('image')->getClientOriginalName();
        Storage::disk('public')->putFileAs('', $request->file('image'), $fileName);

        ReviewPost::create([
            'review_id' => $review_id->id,
            'review_text' => $request->text,
            'review_pic' => Storage::disk('public')->url($fileName)
        ]);

        return redirect('/');
    }

    public function updateReview(Request $request)
    {
        $review = 0;
        for ($i = 1; $i < 6; $i++) {
            $reviewNum = "review" . $i;
            $review = $review + $request->$reviewNum;
        }
        Review::where('user_id',Auth::id())->where('shop_id',$request->shop_id)->update([
            'user_id' => Auth::id(),
            'shop_id' => $request->shop_id,
            'review' => $review
        ]);

        $review_id = Review::where('user_id', Auth::id())->where('shop_id',$request->shop_id)->first('id');
        if($request->image == null){
            ReviewPost::where('review_id', $review_id->id)->update([
                'review_text' => $request->text
            ]);
        } else {
            $fileName = $request->file('image')->getClientOriginalName();
            Storage::disk('public')->putFileAs('', $request->file('image'), $fileName);

            ReviewPost::where('review_id', $review_id->id)->update([
                'review_text' => $request->text,
                'review_pic' => Storage::disk('public')->url($fileName)
            ]);
        }

        return redirect('/');
    }

    public function deleteReview(Request $request){

        Review::where('user_id', Auth::id())->where('id', $request->review_id)->Delete();

        return back();
    }

}