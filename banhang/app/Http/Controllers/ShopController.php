<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
class ShopController extends Controller
{
    //người dùng
    public function gioi_thieu(){
        return view('thongtinshop.gioithieu'); 
    }

    //admin
    public function logo(){
        return view('admin.static.logo');
    }

    public function thong_tin_shop(Request  $request){
        return view('admin.thongtinshop.thong-tin-cua-shop');
    }

    public function admin_gioi_thieu(){
        return view('admin.static.gioi-thieu');
    }
}
