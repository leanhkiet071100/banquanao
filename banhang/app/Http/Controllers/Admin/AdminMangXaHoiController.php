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
use Illuminate\Support\Facades\Validator;
use App\Models\hinh_anh;

class AdminMangXaHoiController extends Controller
{
     public function mang_xa_hoi(){
        $ls_mang_xa_hoi = hinh_anh::where('loai',2)->get();
        return view('admin.hinhanh.mang-xa-hoi')->with(['ls_mang_xa_hoi'=>$ls_mang_xa_hoi]);
    }
    public function get_mang_xa_hoi_them(){
        return view('admin.hinhanh.mang-xa-hoi-them');
    }

    public function post_mang_xa_hoi_them(Request $request){
        $rule = [
            'hinh-mang-xa-hoi'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tieu-de' => 'required',
            'link'=>'required|url',    
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'image' => 'Đây không phải là hình ảnh',
            'mimes' => 'hình ảnh phải có đuối là: jpeg,png,jpg,gif,svg',
            'url' => 'Vui lòng nhập đúng URL',
        ];
        $attribute = [
            'hinh-mang-xa-hoi'=> 'Hình ảnh',
            'tieu-de' => 'tiêu đề',
            'link'=>'link', 
        ];

        $request->validate($rule, $message, $attribute);

        $hinh_anh = $request->file('hinh-mang-xa-hoi');
        $tieu_de = $request->input('tieu-de');
        $link = $request->input('link');
        $hien = $request->has('check-hien');
        if($request->hasFile('hinh-mang-xa-hoi'))
        {
            $date = Carbon::now();
            $date = $date->format('dmy');
            $mang_xa_hoi = new hinh_anh;
            $mang_xa_hoi->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'loai'=>2,
                    'hien'=>$hien,
                    'hinh_anh'=>$hinh_anh,
            ]);
            $mang_xa_hoi->save();
            $file_name = $date.$hinh_anh->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $hinh_anh->move(public_path('quan_li_hinh_anh/'.'hinh_mang_xa_hoi/'.$mang_xa_hoi->id.'/'), $file_name);
            $mang_xa_hoi->hinh_anh = 'quan_li_hinh_anh/'.'hinh_mang_xa_hoi/'.$mang_xa_hoi->id.'/'.$file_name;
            $mang_xa_hoi->save();
        }

        return Redirect::route('admin.mang-xa-hoi')->with('success','Thêm dữ liệu thành công');
    }

     public function get_mang_xa_hoi_sua($id){
        $mang_xa_hoi = hinh_anh::where('loai','=',2)->find($id);
        return view('admin.hinhanh.mang-xa-hoi-sua')->with('mang_xa_hoi',$mang_xa_hoi);
    }

    public function post_mang_xa_hoi_sua(Request $request, $id){
        $rule = [
            'hinh-mang-xa-hoi'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tieu-de' => 'required',
            'link'=>'required|url',    
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'image' => 'Đây không phải là hình ảnh',
            'mimes' => 'hình ảnh phải có đuối là: jpeg,png,jpg,gif,svg',
            'url' => 'Vui lòng nhập đúng URL',
        ];
        $attribute = [
            'hinh-mang-xa-hoi'=> 'Hình ảnh',
            'tieu-de' => 'tiêu đề',
            'link'=>'link', 
        ];

        $request->validate($rule, $message, $attribute);

        $hinh_anh = $request->file('hinh-mang-xa-hoi');
       
        $tieu_de = $request->input('tieu-de');
        
        $link = $request->input('link');
        $hien = $request->has('check-hien');
        $noi_bat = $request->has('check-noi-bat');
        if($request->hasFile('hinh-mang-xa-hoi'))
        {
            $date = Carbon::now();
            $date = $date->format('dmy');
            $mang_xa_hoi = hinh_anh::where('loai','=',2)->find($id);
            unlink($mang_xa_hoi->hinh_anh);
            $mang_xa_hoi->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'hien'=>$hien,
                    'hinh_anh'=>$hinh_anh,
            ]);
            $file_name = $date.$hinh_anh->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $hinh_anh->move(public_path('quan_li_hinh_anh/'.'hinh_mang_xa_hoi/'.$mang_xa_hoi->id.'/'), $file_name);
            $mang_xa_hoi->hinh_anh = 'quan_li_hinh_anh/'.'hinh_mang_xa_hoi/'.$mang_xa_hoi->id.'/'.$file_name;
            $mang_xa_hoi->save();
        }
        else {
            $mang_xa_hoi = hinh_anh::find($id);
            $mang_xa_hoi->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'hien'=>$hien,
                    'noi_bat'=>$noi_bat,
            ]);
            $mang_xa_hoi->save();
        }

        return Redirect::route('admin.mang-xa-hoi')->with('success','Sửa dữ liệu thành công');
    }

    public function mang_xa_hoi_xoa($id){
        $mang_xa_hoi = hinh_anh::find($id);
        $mang_xa_hoi->delete();
        return Redirect::route('admin.mang-xa-hoi')->with('success','Xóa dữ liệu thành công');
    }

    public function mang_xa_hoi_hien(Request $request,$id){
        $check = $request->check;
        $mang_xa_hoi = hinh_anh::find($id);
        if($check=="true"){
            $mang_xa_hoi->fill([
                'hien'=>1
            ]);
        }else{
            $mang_xa_hoi->fill([
                'hien'=>0
            ]);
        }
        $mang_xa_hoi->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }
}
