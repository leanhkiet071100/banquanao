<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\baiviet;
use App\Models\logo;
use App\Models\nguoidung;
use App\Models\gio_hang;
use App\Models\thong_tin_shop;
use Illuminate\Support\Str;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mail;

class IndexController extends Controller
{
    public function __construct(){

    }

    public function thong_tin_shop(){
        $shop = thong_tin_shop::orderBy('id')->first();
        $ten_shop = $shop->ten_shop;
        $email_shop = $shop->email;
        return $shop;

    }
    //admin đăng nhập
      public function login_admin(){
        return view('admin.login')->with(['email'=> null,'mat_khau'=>null]);
    }

    public function post_login_admin(Request $request){
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
                    if($nguoidung->cap == 1){
                        $request->session()->regenerate();
                        Auth::login($nguoidung);

                        $request->session()->put('LoggedUser', $nguoidung->id);
                        return redirect()->route('admin.thong-tin-shop');
                    }
                    else{
                         return view('admin.login')->WithErrors(['error' => 'Xin lỗi bạn không có quyền hạn vào trang này'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
                    }

                }
                else{
                    return view('admin.login')->WithErrors(['error' => 'Sai mật khẩu'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
                    //return redirect()->back()->WithErrors(['error' => 'Sai mật khẩu'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
                }
            }else{
                    return view('admin.login')->WithErrors(['error' => 'Tài khoản đã bị khóa'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
            }
        } else {
            return view('admin.login')->WithErrors(['error' => 'Địa chỉ email sai hoặc không tồn tại'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
        }
    }

    // trang index
    public function count_gio_hang(){
        if(Auth::user()!= null ){
            $iduser = Auth::user()->id;
            $count = gio_hang::where('ma_nguoi_dung','=',$iduser)->count();
        }
        else{ $count = null;}

        return $count;
    }

    public function index()
    {
        $count = $this->count_gio_hang();

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
                                             'lsbaivietnb'=>$lsbaivietnb,
                                             'count'=>$count]);
    }

    //đăng nhập user
    public function dang_nhap()
    {
        return view('auth.dangnhap')->with(['email'=> null,'mat_khau'=>null]);
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
                if(Hash::check($request->input('mat-khau'),$nguoidung->mat_khau)){
                    if($nguoidung->trang_thai == 0)
                    {
                        return view('auth.dangnhap')->WithErrors(['error' => 'Tài khoản của bạn chưa kích hoạt,'])->with(['email'=> $email,'mat_khau'=>$mat_khau,'kiet'=>'lê anh kiệt']);
                    }
                    elseif($nguoidung->trang_thai==2)
                    {
                        return view('auth.dangnhap')->WithErrors(['error' => 'Tài khoản của bạn bị khóa vui lòng liên hệ admin'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);

                    }
                    else{
                        $request->session()->regenerate();
                        Auth::login($nguoidung);
                        $request->session()->put('LoggedUser', $nguoidung->id);
                        return redirect()->route('index');
                    }
                }
                else{
                    return view('auth.dangnhap')->WithErrors(['error' => 'Sai mật khẩu'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
                    //return redirect()->back()->WithErrors(['error' => 'Sai mật khẩu'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
                }
        } else {
            return view('auth.dangnhap')->WithErrors(['error' => 'Địa chỉ email sai hoặc không tồn tại'])->with(['email'=> $email,'mat_khau'=>$mat_khau]);
        }
    }

    //đăng kí
     public function dang_ki()
    {
        return view('auth.dangki')->with(['email'=>null,'mat_khau'=>null,'ho_ten'=>null,'sdt'=>null]);
    }

    public function post_dang_ki(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email|max:255|unique:nguoidungs,email',
                'mat-khau' => 'required|min:6',
                'ho-ten' => 'required',
                'sdt' => 'required|numeric',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'mat-khau.required' => 'Vui lòng nhập mật khẩu',
                'mat-khau.min' => 'Mật khẩu ít nhất 6 ký tự',
                'ho-ten.required' => 'Vui lòng nhập họ tên',
                'sdt.required' => 'Vui lòng nhập họ tên',
                'sdt.numeric' => 'Số điện thoại phải là số',
            ]);

        // thông tin của shop
        $shop = thong_tin_shop::orderBy('id')->first();
        $ten_shop = $shop->ten_shop;
        $email_shop = $shop->email;
        $hinh_anh = logo::orderBy('id')->first();
        // thông tin người dung
        $sdt = $request->input('sdt');
        $ho_ten = $request->input('ho-ten');
        $email = $request->email;
        $mat_khau = $request->input('mat-khau');
        $token = strtoupper(Str::random(10));

        // mail::send('tenview',(['gắn biến'])
        $nguoidung = nguoidung::create([
                    'ten' => $ho_ten,
                    'email' => $email,
                    'so_dien_thoai'  => $sdt,
                    'remember_token' => $token,
                    'mat_khau' => Hash::make($mat_khau),
                    'cap' => 2,
                    'trang_thai' => 0
                ]);

        // vd: Mail::send('email.dangki',['name'=>'test']);

        Mail::send('email.dangki',compact('nguoidung'), function($email) use($shop, $nguoidung,$hinh_anh){
            // $email->to('địa chỉ email nhận','tên người nhận')
            //$email->subject('Xác nhận đăng kí tài khoản');
            // lấy file
            //$email->attach('C:\laravel-master\laravel\public\uploads\image.png');
            //$email->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            //email gửi

            if($shop != null){
                $email->from($shop->email,$shop->ten_shop);
            }else{
                $email->from('0306191038@caothang.edu.vn','cửa hàng quần áo');
            }
            // gửi thêm tệp đính kèm
            //$email->attach(public_path($hinh_anh->hinh_logo));

            // email nhận
            $email->to($nguoidung->email,$nguoidung->ten)->subject('XÁC NHẬN ĐĂNG KÍ TÀI KHOẢN');
        });
        return Redirect::route('dang-nhap')->With(['yes' => 'Vui lòng check email để kích hoạt tài khoản']);
    }

    public function kich_hoat($id, $token){
        $nguoidung = nguoidung::find($id);
        if($nguoidung->remember_token === $token){
            $nguoidung->update(['trang_thai'=>1,'token'=>null]);
            return view('auth.dangnhap')->with('success','Xác nhận thành công, bạn có hể đăng nhập');
        }else {
            return view('auth.dangnhap')->WithErrors(['error' => 'xác  nhận không thành công']);
        }

    }

    //đăng xuất
    public function dang_xuat(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('dang-nhap');
    }

    // quên mật khẩu
    public function quen_mat_khau(){
        return view('auth.quen-mat-khau')->with(['email'=> null]);
    }
     public function post_quen_mat_khau(){
        $shop = $this->thong_tin_shop();

    }

}
