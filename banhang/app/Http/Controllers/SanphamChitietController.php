<?php

namespace App\Http\Controllers;

use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\sanpham;
use App\Models\sanpham_hinhanh;
use App\Models\sanpham_binhluan;
use App\Models\sanpham_binhluan_hinhanh;
use App\Http\Requests\Storesanpham_chitietRequest;
use App\Http\Requests\Updatesanpham_chitietRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Random;


class SanphamChitietController extends Controller
{
    public function chi_tiet_san_pham($id)
    {
        $sanpham =  sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                    ->join('nhan_hieus','Nhan_hieus.id', '=','sanphams.ma_nhan_hieu')
                    ->select('nhan_hieus.ten_nhan_hieu','sanphams.*','loai_san_phams.ten_loai_san_pham')
                    ->find($id);
        $id_loai_san_pham =  sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                    ->join('nhan_hieus','Nhan_hieus.id', '=','sanphams.ma_nhan_hieu')
                    ->select('loai_san_phams.id','loai_san_phams.ten_loai_san_pham')
                    ->find($id);
        $lsloaisanpham = loai_san_pham::where('hien','=',1)->get();
        $lshinhanh = sanpham_hinhanh::where('ma_san_pham',$id)->get();
        $id_loai_san_pham = $id_loai_san_pham->id;
        $lssanphamlienquan =sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                    ->join('nhan_hieus','Nhan_hieus.id', '=','sanphams.ma_nhan_hieu')
                    ->select('nhan_hieus.ten_nhan_hieu','sanphams.*','loai_san_phams.ten_loai_san_pham')
                    ->where('loai_san_phams.id','=',$id_loai_san_pham)
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();
        $ls_binh_luan = sanpham_binhluan::join('nguoidungs','nguoidungs.id', '=','sanpham_binhluans.ma_nguoi_dung')
                                        ->select('sanpham_binhluans.*','nguoidungs.ten','nguoidungs.hinh_dai_dien','nguoidungs.cap')
                                        ->where('ma_san_pham','=',$id)
                                        ->where('sanpham_binhluans.hien','=',1)
                                        ->where('sanpham_binhluans.id_binh_luan_cha','=',null)
                                        ->get();
        $ls_binh_luan_hinh_anh = sanpham_binhluan_hinhanh::join('sanpham_binhluans','sanpham_binhluans.id', '=','sanpham_binhluan_hinhanhs.ma_binh_luan')
                                                        ->select('sanpham_binhluan_hinhanhs.*')
                                                        ->where('sanpham_binhluans.ma_san_pham','=',$id)->get();
        $ls_tra_loi = sanpham_binhluan::join('nguoidungs','nguoidungs.id', '=','sanpham_binhluans.ma_nguoi_dung')
                                        ->select('sanpham_binhluans.*','nguoidungs.ten','nguoidungs.hinh_dai_dien','nguoidungs.cap')
                                        ->where('ma_san_pham','=',$id)
                                        ->where('sanpham_binhluans.hien','=',1)
                                        ->where('sanpham_binhluans.id_binh_luan_cha','!=',null)
                                        ->get();
                               
        return view('sanpham.chitietsanpham')->with(['lsloaisanpham'=>$lsloaisanpham,'sanpham'=>$sanpham,'lshinhanh'=>$lshinhanh,
                                                    'lssanphamlienquan'=>$lssanphamlienquan,
                                                    'ls_binh_luan'=>$ls_binh_luan,
                                                    'ls_binh_luan_hinh_anh'=>$ls_binh_luan_hinh_anh,
                                                    'ls_tra_loi'=>$ls_tra_loi,]);
    }

}
