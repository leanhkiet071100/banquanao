<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\baiviet;
use App\Models\nguoidung;
use Illuminate\Support\Str;
Use Illuminate\Support\Facades\Auth;
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

    public function dang_nhap()
    {
        return view('dangnhap-dangki.dangnhap')->with(['email'=> null,'mat_khau'=>null]);
    }

    public function post_dang_nhap(Request $request){
        $this->validate($request,
            [
                'email' => 'required|email|max:255',
                'mat-khau' => 'required|min:6'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.regex' => 'Email phải có dạng: caothang.edu.vn',
                'mat-khau.required' => 'Vui lòng nhập mật khẩu',
                'mat-khau.min' => 'Mật khẩu ít nhất 6 ký tự',
            ]);
        $email = $request->email;
        $mat_khau = $request->input('mat-khau');
        $nguoidung = nguoidung::where('email', $email)->first();
        // dd($nguoidung,$request->matkhau,Hash::check($request->matkhau,$nguoidung->password));
        if($nguoidung!=null){
            if($nguoidung->trang_thai == 1){
                if(Hash::check($request->input('mat-khau'),$nguoidung->mat_khau)){
                    $request->session()->regenerate();
                    Auth::login($nguoidung);
                   
                    //$request->session()->put('LoggedUser', $nguoidung->id);
                    return redirect()->route('index');
                }
                else{
                    return view('dangnhap-dangki.dangnhap')->WithErrors(['error' => 'Sai mật khẩu'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
                    //return redirect()->back()->WithErrors(['error' => 'Sai mật khẩu'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
                }
            }else{
                    return view('dangnhap-dangki.dangnhap')->WithErrors(['error' => 'Tài khoản đã bị khóa'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
            }
        } else {
            return view('dangnhap-dangki.dangnhap')->WithErrors(['error' => 'Địa chỉ email sai hoặc không tồn tại'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
        }
    }

     public function dang_ki()
    {
        return view('dangnhap-dangki.dangki');
    }

     public function post_dang_ki()
    {
        return view('dangnhap-dangki.dangki');
    }


}
