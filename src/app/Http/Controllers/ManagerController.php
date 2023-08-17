<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shop;

class ManagerController extends Controller
{
    public function index(){

        $representives = user::where('role',2)->get();

        return view('managerRegister',compact('representives'));
    }

    public function store(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=> $request->role,
        ]);

        return redirect()->back();
    }

    public function shopIndex(){
        $RegisteredShops = Shop::where('registered_id',Auth::id())->get();
        
        return view('representive',compact('RegisteredShops'));
    }

    public function shopRegister(Request $request){
        
    }
}
