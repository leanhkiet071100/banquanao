<?php

namespace App\Http\Controllers\admin;

use App\Models\hinh_anh;
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

class AdminHinhAnhController extends Controller
{
     public function hinh_anh(){
        $lshinh_anh = hinh_anh::all();
        return view('admin.hinhanh.hinh_anh')->with(['lshinh_anh'=>$lshinh_anh]);
    }
    public function get_hinh_anh_them(){
        return view('admin.hinhanh.hinh_anh-them');
    }

    public function post_hinh_anh_them(Request $request){
        $rule = [
            'hinh-anh'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'hinh-hinh_anh'=> 'Hình ảnh',
            'tieu-de' => 'tiêu đề',
            'link'=>'link', 
        ];

        $request->validate($rule, $message, $attribute);

        $hinh_anh = $request->file('hinh_anh');
       
        $tieu_de = $request->input('tieu-de');
        
        $link = $request->input('link');
        $hien = $request->has('check-hien');
        $noi_bat = $request->has('check-noi-bat');
        if($request->hasFile('hinh-hinh_anh'))
        {
            $date = Carbon::now();
            $date = $date->format('dmy');
            $hinh_anh = new hinh_anh;
            $hinh_anh->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'hien'=>$hien,
                    'noi_bat'=>$noi_bat,
                    'hinh_hinh_anh'=>$hinh_anh,
            ]);
            $hinh_anh->save();
            $file_name = $date.$hinh_anh->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $hinh_anh->move(public_path('quan_li_hinh_anh/'.'hinh_slideshow/'.$hinh_anh->id.'/'), $file_name);
            $hinh_anh->hinh_hinh_anh = 'quan_li_hinh_anh/'.'hinh_slideshow/'.$hinh_anh->id.'/'.$file_name;
            $hinh_anh->save();
        }

        return Redirect::route('admin.hinh_anh')->with('success','Thêm dữ liệu thành công');
    }

     public function get_hinh_anh_sua($id){
        $hinh_anh = hinh_anh::find($id);
        return view('admin.hinhanh.hinh_anh-sua')->with('hinh_anh',$hinh_anh);
    }

    public function post_hinh_anh_sua(Request $request, $id){
        $rule = [
            'hinh-anh'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'hinh-hinh_anh'=> 'Hình ảnh',
            'tieu-de' => 'tiêu đề',
            'link'=>'link', 
        ];

        $request->validate($rule, $message, $attribute);

        $hinh_anh = $request->file('hinh-hinh_anh');
        $tieu_de = $request->input('tieu-de');
        $link = $request->input('link');
        $hien = $request->has('check-hien');
        $noi_bat = $request->has('check-noi-bat');
        if($request->hasFile('hinh-hinh_anh'))
        {
            $date = Carbon::now();
            $date = $date->format('dmy');
            $hinh_anh = hinh_anh::find($id);
            $hinh_anh->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'hien'=>$hien,
                    'noi_bat'=>$noi_bat,
                    'hinh_hinh_anh'=>$hinh_anh,
            ]);
            $file_name = $date.$hinh_anh->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $hinh_anh->move(public_path('quan_li_hinh_anh/'.'hinh_hinh_anh/'.$hinh_anh->id.'/'), $file_name);
            $hinh_anh->hinh_hinh_anh = 'quan_li_hinh_anh/'.'hinh_hinh_anh/'.$hinh_anh->id.'/'.$file_name;
             $hinh_anh->save();
        }
        else {
            $hinh_anh = hinh_anh::find($id);
            $hinh_anh->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'hien'=>$hien,
                    'noi_bat'=>$noi_bat,
            ]);
             $hinh_anh->save();
        }

        return Redirect::route('admin.hinh_anh')->with('success','Sửa dữ liệu thành công');
    }

    public function hinh_anh_xoa($id){
        $hinh_anh = hinh_anh::find($id);
        $hinh_anh->delete();
        return Redirect::route('admin.hinh_anh')->with('success','Xóa dữ liệu thành công');
    }

    public function hinh_anh_noi_bat(Request $request,$id){
        $check = $request->check;
        $hinh_anh = hinh_anh::find($id);
        if($check=="true"){
            $hinh_anh->fill([
                'noi_bat'=>1
            ]);
        }else{
            $hinh_anh->fill([
                'noi_bat'=>0
            ]);
        }
        $hinh_anh->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

    public function hinh_anh_hien(Request $request,$id){
        $check = $request->check;
        $hinh_anh = hinh_anh::find($id);
        if($check=="true"){
            $hinh_anh->fill([
                'hien'=>1
            ]);
        }else{
            $hinh_anh->fill([
                'hien'=>0
            ]);
        }
        $hinh_anh->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }
}
