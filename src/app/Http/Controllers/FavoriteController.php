<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\FavoriteAjax;
use App\Libs\FavoriteParam;

class FavoriteController extends Controller
{
    public function create(Request $request){
        $user_id = $request->user_id;
        $shop_id = $request->shop_id;

        $param = new FavoriteParam();
        $param->user_param = $user_id;
        $param->shop_param = $shop_id;
        FavoriteAjax::dispatch($param);

        return redirect('/');
    }
}