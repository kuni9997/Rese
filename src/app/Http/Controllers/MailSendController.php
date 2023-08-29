<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Mail\noticeMail;
use Illuminate\Support\Facades\Mail;


class MailSendController extends Controller
{
    public function index(){
        return view('noticeMailForm');
    }
    public function send(Request $request){
        $request->validate([
            "sendTo" => "required",
            "text" => "required|max:1000"
        ],
        [
            'sendTo.required' => "送信先を選択してください。",
            'text.required' => "メール本文を入力してください。",
            'text.max' => "メール本文は1000文字以内で入力してください。"
        ]);
        
        $send_users = user::all();
        foreach($send_users as $send_user){
        $name = $send_user->name;
        $text = $request->text;

        mail::to($send_user->email)->send(new noticeMail($name,$text));
        }
        return view('mailSend');
    }
}
