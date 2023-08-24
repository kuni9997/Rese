<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\noticeMail;
use App\Models\user;
use Illuminate\Support\Facades\Mail;


class MailSendController extends Controller
{
    public function send(Request $request){
        $request->validate([
            "send-to" => "required",
            "text" => "required|max:1000"
        ]);
        
        $send_address = user::where('id','1')->first();

        mail::to($send_address->email)->send(new noticeMail());

        return view('mailSend');
    }
}
