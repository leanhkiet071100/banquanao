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

}
