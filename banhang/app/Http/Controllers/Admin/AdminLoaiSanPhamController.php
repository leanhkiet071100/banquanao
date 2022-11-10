<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Validator;
use App\Models\loai_san_pham;


class AdminLoaiSanPhamController extends Controller
{
    public function get_loai_san_pham(){
        $lsloaisanpham = loai_san_pham::all();
        return  view('admin.loaisanpham.loaisanpham-ds');
    }
}
