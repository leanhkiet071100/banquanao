<?php

namespace App\Http\Controllers;

use App\Models\hoadon;
use App\Models\hoadon_chitiet;
use App\Models\gio_hang;
use App\Models\sanpham;
use App\Models\nguoidung_diachi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\GioHangController;
class HoadonController extends Controller
{
    public function xuat_hoa_don(GioHangController $gio_hang)
    {
        $tong_tien_gio_hang = $gio_hang->tong_tien_gio_hang();
        $gio_hang = $gio_hang->gio_hang_ca_nhan();
        $dia_chi = nguoidung_diachi::where('mac_dinh','=',1)->first();

        return view('hoadon.xuathoadon')->with(['tong_tien_gio_hang'=>$tong_tien_gio_hang, 'gio_hang'=>$gio_hang, 'dia_chi'=>$dia_chi]);

    }

    public function thanh_toan_hoa_don(request $request, GioHangController $gio_hang)
    {
       $iduser = Auth::user()->id;
       $ma_giam_gia = $request->ma_giam_gia;
       $tien_hoa_don = $request->tien_hoa_don;
       $ho_ten = $request->ho_ten;
       $so_dien_thoai  = $request->input('so-dien-thoai');
       $dia_chi = $request->input('dia-chi-cu-the');
       $ghi_chu = $request->input('ghi-chu');
       $gio_hang = $gio_hang->gio_hang_ca_nhan();
       //return array([$iduser,$tien_hoa_don,$ho_ten,$so_dien_thoai,$dia_chi,$ghi_chu]);
       //lưu hóa đơn
       $hoadon = new hoadon;
       $hoadon->fill([
            $hoadon->ma_nguoi_dung = $iduser,
            $hoadon->ma_giam_gia = $ma_giam_gia,
            $hoadon->tien_hoa_don = $tien_hoa_don,
            $hoadon->ho_ten = $ho_ten,
            $hoadon->so_dien_thoai = $so_dien_thoai,
            $hoadon->dia_chi_cu_the = $dia_chi,
            $hoadon->ghi_chu = $ghi_chu,
            $hoadon->trang_thai = 1,
        ]);
        //lưu chi tiết hóa đơn
        $hoadon->save();
        foreach($gio_hang as $key=>$value)
        {
            $tong_tien_sp =( $value->gia - $value->gia * ($value->tien_giam / 100)) * $value->so_luong;
           
            $hoadon_chitiet = new hoadon_chitiet;
            $hoadon_chitiet->fill([
                $hoadon_chitiet->ma_hoa_don = $hoadon->id,
                $hoadon_chitiet->ma_san_pham = $value->ma_san_pham,
                $hoadon_chitiet->so_luong = $value->so_luong,
                $hoadon_chitiet->tong_tien = $tong_tien_sp,
                $hoadon_chitiet->trang_thai = 1,
            ]);
            $hoadon_chitiet->save();
            $value->forceDelete();
        }
        
        
       
        return "theme hoas  don thanh cong";
    }

    public function store(StorehoadonRequest $request)
    {
        
    }

    public function show(hoadon $hoadon)
    {
        //
    }

    public function edit(hoadon $hoadon)
    {
        //
    }

    public function update(UpdatehoadonRequest $request, hoadon $hoadon)
    {
        //
    }

    public function destroy(hoadon $hoadon)
    {
        //
    }
}
