<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminShopController extends Controller
{
    public function thong_tin_shop(Request  $request){
        return view('admin.thongtinshop.thong-tin-cua-shop');
    }
}
