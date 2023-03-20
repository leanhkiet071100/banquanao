<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hoadon;
use App\Models\hoadon_chitiet;

class AdmimHoadonController extends Controller
{
    public function don_hang_all(Request $request){
        $search = $request->input('search');
        $don_hang = hoadon::all();
        $so_luong = array();
        foreach($don_hang as $key=>$value){
        $count = hoadon_chitiet::where('ma_hoa_don','=',$value->id)->count();
           array_push($so_luong, $count);
        }
        return view('admin.donhang.donhang-ds')->with(['don_hang'=>$don_hang, 'so_luong'=>$so_luong]);
    }

    public function don_hang_cho_xac_nhan(Request $request){
        $search = $request->input('search');
        $don_hang = hoadon::where('trang_thai','=',1)->orderByRaw('id DESC')->get();
        $so_luong = array();
        foreach($don_hang as $key=>$value){
        $count = hoadon_chitiet::where('ma_hoa_don','=',$value->id)->count();
           array_push($so_luong, $count);
        }
        return view('admin.donhang.donhang-choxacnhan')->with(['don_hang'=>$don_hang, 'so_luong'=>$so_luong]);
    }

    public function don_hang_van_chuyen(Request $request){
        $search = $request->input('search');
        $don_hang = hoadon::where('trang_thai','=',2)->orderByRaw('id DESC')->get();
        $so_luong = array();
        foreach($don_hang as $key=>$value){
        $count = hoadon_chitiet::where('ma_hoa_don','=',$value->id)->count();
           array_push($so_luong, $count);
        }
        return view('admin.donhang.donhang-vanchuyen')->with(['don_hang'=>$don_hang, 'so_luong'=>$so_luong]);
    }

    public function don_hang_dang_giao(Request $request){
        $search = $request->input('search');
        $don_hang = hoadon::where('trang_thai','=',3)->orderByRaw('id DESC')->get();
        $so_luong = array();
        foreach($don_hang as $key=>$value){
        $count = hoadon_chitiet::where('ma_hoa_don','=',$value->id)->count();
           array_push($so_luong, $count);
        }
        return view('admin.donhang.donhang-danggiao')->with(['don_hang'=>$don_hang, 'so_luong'=>$so_luong]);
    }

    public function don_hang_hoan_thanh(Request $request){
        $search = $request->input('search');
        $don_hang = hoadon::where('trang_thai','=',4)->orderByRaw('id DESC')->get();
        $so_luong = array();
        foreach($don_hang as $key=>$value){
        $count = hoadon_chitiet::where('ma_hoa_don','=',$value->id)->count();
           array_push($so_luong, $count);
        }
        return view('admin.donhang.donhang-hoanthanh')->with(['don_hang'=>$don_hang, 'so_luong'=>$so_luong]);
    }

    public function don_hang_bi_huy(Request $request){
        $search = $request->input('search');
        $don_hang = hoadon::where('trang_thai','=',0)->orderByRaw('id DESC')->get();
        $so_luong = array();
        foreach($don_hang as $key=>$value){
        $count = hoadon_chitiet::where('ma_hoa_don','=',$value->id)->count();
           array_push($so_luong, $count);
        }
        return view('admin.donhang.donhang-bihuy')->with(['don_hang'=>$don_hang, 'so_luong'=>$so_luong]);
    }

    public function don_hang_tra_hang(Request $request){
        $search = $request->input('search');
        $don_hang = hoadon::where('trang_thai','=',5)->orderByRaw('id DESC')->get();
        $so_luong = array();
        foreach($don_hang as $key=>$value){
        $count = hoadon_chitiet::where('ma_hoa_don','=',$value->id)->count();
           array_push($so_luong, $count);
        }
        return view('admin.donhang.donhang-trahang')->with(['don_hang'=>$don_hang, 'so_luong'=>$so_luong]);
    }

    public function don_hang_chi_tiet($id){
        $donhang_chitiet = hoadon_chitiet::join('sanphams','sanphams.id', '=','hoadon_chitiets.ma_san_pham')
                            ->select('hoadon_chitiets.*','sanphams.ten_san_pham','sanphams.gia','sanphams.hinh_anh','sanphams.tien_giam')
                            ->where('ma_hoa_don','=',$id)
                            ->get();
        $don_hang = hoadon::find($id);
        return view('admin.donhang.donhang-chitiet')->with(['donhang_chitiet'=>$donhang_chitiet,  'don_hang'=>$don_hang]);
    }

    public function don_hang_huy($id){
        $don_hang = hoadon::find($id);
        $don_hang->update(['trang_thai' => '0' ]);
        return response()->json([
                'status'=>200,
                'mess'=>  'Sửa thành công',
                'don_hang'=>$don_hang,
            ]);
    }

    public function don_hang_chuc_nang($id){
        $don_hang = hoadon::find($id);
        $don_hang->fill(['trang_thai' => $don_hang->trang_thai + 1 ]);
        $don_hang->save();
        return response()->json([
                'status'=>200,
                'mess'=>  'Sửa thành công',
                'don_hang'=>$don_hang,
            ]);
    }
}
