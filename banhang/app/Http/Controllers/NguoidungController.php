<?php

namespace App\Http\Controllers;

use App\Models\nguoidung;

use App\Models\nguoidung_diachi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;

class NguoidungController extends Controller
{
    public function index()
    {
        return view('nguoidung.tai-khoan');
    }

    public function doi_mat_khau()
    {
         return view('nguoidung.doi-mat-khau');
    }

    public function  post_doi_mat_khau(Request $request)
    {   
        $id = Auth::user()->id;
        $nguoidung = nguoidung::find($id);
        if(Auth::user()->mat_khau == null){
        $rule = [
            'mat-khau' => ['required','min:6', 'max:50'],
            'xac-nhan-mat-khau'=>'min:6| max:50',
            'ma-xac-nhan'=> 'required|max:50',
        ];
        }else{
            $rule = [
            'mat-khau' => ['required','min:6','max:50',
                function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->mat_khau)) {
                    $fail('Mật khẩu sai');
                }
                },
            ],
            'mat-khau-moi'=> 'required|min:6| max:50|different:mat-khau',
            'xac-nhan-mat-khau-moi' => 'required|min:6| max:50|same:mat-khau-moi',
            ];
        }
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'image'=> ':attribute phải là hình ảnh',
            'same' => ':attribute không trùng với mật khẩu mới',
            'different' => ':attribute phải khác mật khẩu cũ',
         
        ];
        $attribute = [
            'mat-khau' => 'mật khẩu',
            'xac-nhan-mat-khau'=>'Xác nhận mật khẩu',
            'ma-xac-nhan' => 'Ma xác nhận',
            'mat-khau-moi' => 'Mật khẩu mới',
            'xac-nhan-mat-khau-moi' => 'Xác nhận mật khẩu mới'
        ];
        $request->validate($rule, $message, $attribute);
        $mat_khau= $request->input('mat-khau');

        if(!(Hash::check($mat_khau, Auth::user()->mat_khau)))
        {
            return Redirect::back()->withErrors('mat-khau', 'Mật khẩu sai');
        }
       
        $mat_khau = $request->input('mat-khau');
        $mat_khau_moi = $request->input('mat-khau-moi');
        $xac_nhan_mat_khau_moi = $request->input('xac-nhan-mat-khau-moi');
        
        $nguoidung->update([
            'mat_khau' => Hash::make($mat_khau_moi),

        ]);
        $nguoidung->save();
        return Redirect::route('tai-khoan.doi-mat-khau')->with('success','Đổi mật khẩu thành công');
       
    }

    public function dia_chi()
    {

         return view('nguoidung.dia-chi');
    }

    public function get_dia_chi(){

    } 

    public function post_dia_chi(){
     return "Kiệt";
    }

    public function thay_doi_tai_khoan(Request $request){
         $rule = [
            'ho-ten' => 'required|min:6| max:25',
            'anh-dai-dien'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'image'=> ':attribute phải là hình ảnh',
            'mimes' => 'hình ảnh phải có đuổi là: jpeg,png,jpg,gif,svg',
        ];
        $attribute = [
            'ho-ten' => 'Họ tên',
            'anh-dai-dien'=>'Ảnh đại diện',
            
        ];

        $request->validate($rule, $message, $attribute);
        $ho_ten = $request->input('ho-ten');
        $anh_dai_dien = $request->file('anh-dai-dien');
        $id = Auth::user()->id;
         $nguoidung = nguoidung::find($id);
         $nguoidung->update([
                'ten' => $ho_ten,
            ]);
            
        if($request->hasFile('anh-dai-dien')){ 
            if(Auth::user()->hinh_dai_dien != null)
            {
                unlink($nguoidung->hinh_dai_dien);
            }
            $file_name = $anh_dai_dien->getClientoriginalName();
            // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $anh_dai_dien->move(public_path('hinh_nguoi_dung/'.$id), $file_name);
            $nguoidung->hinh_dai_dien = 'hinh_nguoi_dung/'.$id.'/'.$file_name;
            $nguoidung->save();
        }
        $nguoidung->save();

        return Redirect::route('tai-khoan.tai-khoan')->with('success','Sửa thông tin tài khoản thành công');
        
    }


}
