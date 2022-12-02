<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\baiviet;
use App\Http\Requests\StoresanphamRequest;
use App\Http\Requests\UpdatesanphamRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $lsloaisanpham = loai_san_pham::where('hien','=',1)->get();
        $lsnhanhieu = nhan_hieu::where('hien','=',1)->get();
        $lsloaisanphamnoibat = loai_san_pham::where('hien','=',1)
                                            ->where('noi_bat','=',1)
                                            ->get();
        $lssanphamnb = sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                            ->select('sanphams.*','loai_san_phams.tag_loai_san_pham')
                            ->where('sanphams.hien','=',1)
                            ->where('sanphams.noi_bat','=',1)
                            ->get();
        $lssanphammoi = sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                            ->select('sanphams.*','loai_san_phams.tag_loai_san_pham')
                            ->where('sanphams.hien','=',1)
                            ->where('sanphams.moi','=',1)
                            ->get();
        $lsbaivietnb = baiviet::where('hien','=',1)->where('noi_bat','=',1)->orderBy('created_at', 'DESC')->paginate(3);
        return view('trangchu.index')->with(['lsloaisanpham'=> $lsloaisanpham,
                                             'lsnhanhieu'=>$lsnhanhieu,
                                             'lsloaisanphamnoibat'=>$lsloaisanphamnoibat,
                                             'lssanphamnb'=>$lssanphamnb,
                                             'lssanphammoi'=>$lssanphammoi,
                                             'lsbaivietnb'=>$lsbaivietnb]);
    }
}
