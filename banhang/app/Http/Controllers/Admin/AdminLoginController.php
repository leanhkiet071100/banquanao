<?php

namespace App\Http\Controllers\Admin;

use App\Models\nguoidung;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\Mail;

class AdminLoginController extends Controller
{
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

    public function logout_admin(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('login-admin');
    }
}
