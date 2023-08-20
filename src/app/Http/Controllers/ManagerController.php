<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Shop;

class ManagerController extends Controller
{
    public function index(){

        $representatives = user::where('role',2)->get();

        return view('managerRegister',compact('representatives'));
    }

    public function store(Request $request){

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=> $request->role,
        ]);

        return redirect()->back();
    }

    public function shopIndex(){
        $RegisteredShops = Shop::where('registered_id',Auth::id())->get();
        
        return view('representative',compact('RegisteredShops'));
    }

    public function shopRegister(Request $request){
        $fileName = $request->file('image')->getClientOriginalName();
        Storage::disk('public')->putFileAs('', $request->file('image'),$fileName);

        Shop::create([
            'registered_id' => Auth::id(),
            'shop_name' => $request->shop_name,
            'area' => $request->area,
            'genre' => $request->genre,
            'shop_desc' => $request->shop_desc,
            'pic_url' => Storage::disk('public')->url($fileName)
        ]);

        return redirect()->back();
    }

    public function update_index($shop_id){
        $shop = Shop::where('id', $shop_id)->first();

        return view('representative_update', compact('shop','shop_id'));
    }

    public function update(Request $request, $shop_id){
        if($request->file('image') == null){
            Shop::where('id', $shop_id)->update([
                'shop_name' => $request->shop_name,
                'area' => $request->area,
                'genre' => $request->genre,
                'shop_desc' => $request->shop_desc,
            ]);
        }else{
            $fileName = $request->file('image')->getClientOriginalName();

            Shop::where('id', $shop_id)->update([
                'shop_name' => $request->shop_name,
                'area' => $request->area,
                'genre' => $request->genre,
                'shop_desc' => $request->shop_desc,
                'pic_url' => Storage::disk('public')->url($fileName)
            ]);
        }

        return redirect('/shop');
    }
}
