<?php

namespace App\Http\Controllers;

use App\Models\gio_hang;
use App\Models\sanpham;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\IndexController;
class GioHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gio_hang(IndexController $index)
    {
   
        $iduser = Auth::user()->id;
        $gio_hang = gio_hang::join('sanphams','sanphams.id','=','gio_hangs.ma_san_pham')
                    ->select('gio_hangs.*', 'sanphams.ten_san_pham','sanphams.hinh_anh','sanphams.gia','sanphams.tien_giam')
                    ->where('ma_nguoi_dung','=',$iduser)->get();
        // chia thành giỏ hàng yêu thích Cart::instance('wishlist')->content();
        // tổng tiền trong giỏ hàng Cart::total();
        // tổng tiền phụ trong giỏ hàng ko có thể Cart::subtotal()
        // kiểm tra số lượng tỏng giỏ hàng Cart::count()
        // xóa giỏ hàng Cart::destroy() 
        // Lấy toàn bộ trong giỏ hàng Cart::content() 
        // Xóa một item trong giỏ hàng Cart::remove($rowId);
        return view('giohang.giohang')->with(['gio_hang'=>$gio_hang]);
    }

    public function them_gio_hang( Request $request)
    {
        $rule = [
            'so_luong' => 'required|Numeric|min:1', 
        ];
        $message =[
            'required' => 'Số lượng không được để trống',
            'min' => 'Số lượng phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => 'Số lượng phải nhỏ hơn :max', // nhỏ hơn
            'Numeric'=> 'Số lượng khải là số',
        ];
        $request->validate($rule, $message);
        $iduser = Auth::user()->id;
        $ma_san_pham = $request->idsp;
        $ma_nguoi_dung = Auth::user()->id;
        $so_luong = $request->so_luong;
        $gio_hang_user = gio_hang::where('ma_nguoi_dung','=',$iduser)
                                   ->where('ma_san_pham','=',$ma_san_pham)->first();
        if (isset($gio_hang_user)) {
            $gio_hang_user->so_luong += $so_luong;
            $gio_hang_user->save();
        }
        else{
            $gio_hang = new gio_hang;
            $gio_hang->fill([
            $gio_hang->ma_san_pham = $ma_san_pham,
            $gio_hang->ma_nguoi_dung = $ma_nguoi_dung,
            $gio_hang->so_luong = $so_luong,
            ]);
            $gio_hang->save();
        }

        
        return Redirect::route('gio-hang')->with('success','Đã thêm giỏ hàng thành công');
        
    }

    public function gio_hang_them_san_pham(Request $request, $id)
    {
        $iduser = Auth::user()->id;
        $ma_san_pham = $request->id;
        $ma_nguoi_dung = Auth::user()->id;
        $so_luong = $request->so_luong;
        $gio_hang_user = gio_hang::where('ma_nguoi_dung','=',$iduser)
                                   ->where('ma_san_pham','=',$ma_san_pham)->first();
        if (isset($gio_hang_user)) {
            $gio_hang_user->so_luong += 1;
            $gio_hang_user->save();
        }
        else{
            $gio_hang = new gio_hang;
            $gio_hang->fill([
            $gio_hang->ma_san_pham = $ma_san_pham,
            $gio_hang->ma_nguoi_dung = $ma_nguoi_dung,
            $gio_hang->so_luong =  1,
            ]);
            $gio_hang->save();
        }
        $count = gio_hang::where('ma_nguoi_dung','=',$iduser)->count();
        return response()->json([
                'status'=>200,
                'mess'=>  'sửa thành công',
                'count_gio_hang'=> $count,
            ]);
    }

    public function gio_hang_xoa_san_pham(Request $request, $id){
        $gio_hang = gio_hang::find($id);
        $gio_hang->delete();
        return Redirect::route('gio-hang')->with('success','Xóa thành công');
    }

    public function gio_hang_cap_nhat_so_luong(Request $request){
        $ma_san_pham = $request->ma_san_pham;
        $so_luong = $request->so_luong;
        $gio_hang = gio_hang::where('id','=',$ma_san_pham)->first();
        //$gio_hang = gio_hang::where('id','=',$ma_san_pham)->update(['so_luong' => $so_luong]);
        $gio_hang->update(['so_luong' => $so_luong]);
        $san_pham = sanpham::where('id','=',$gio_hang->ma_san_pham)->first();
        $tong_tien_san_pham = number_format(($san_pham->gia - $san_pham->gia * ($san_pham->tien_giam / 100)) * $gio_hang->so_luong,2, ',', '.');
        return  response()->json([
                'status'=>200,
                'mess'=>'thêm thành công',
               'san_pham'=>$san_pham,
               'tong_tien_san_pham'=>$tong_tien_san_pham,
        ]);
    }

 
}
