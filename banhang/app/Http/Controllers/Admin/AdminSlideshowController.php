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
use App\Models\slideshow;

class AdminSlideshowController extends Controller
{
    public function slideshow(){
        $lsslideshow = slideshow::all();
        return view('admin.hinhanh.slideshow')->with(['lsslideshow'=>$lsslideshow]);
    }
    public function get_slideshow_them(){
        return view('admin.hinhanh.slideshow-them');
    }

    public function post_slideshow_them(Request $request){
        $rule = [
            'hinh-slideshow'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'hinh-slideshow'=> 'Hình ảnh',
            'tieu-de' => 'tiêu đề',
            'link'=>'link', 
        ];

        $request->validate($rule, $message, $attribute);

        $hinh_anh = $request->file('hinh-slideshow');
       
        $tieu_de = $request->input('tieu-de');
        
        $link = $request->input('link');
        $hien = $request->has('check-hien');
        $noi_bat = $request->has('check-noi-bat');
        if($request->hasFile('hinh-slideshow'))
        {
            $date = Carbon::now();
            $date = $date->format('dmy');
            $slideshow = new slideshow;
            $slideshow->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'hien'=>$hien,
                    'noi_bat'=>$noi_bat,
                    'hinh_slideshow'=>$hinh_anh,
            ]);
            $slideshow->save();
            $file_name = $date.$hinh_anh->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $hinh_anh->move(public_path('quan_li_hinh_anh/'.'hinh_slideshow/'.$slideshow->id.'/'), $file_name);
            $slideshow->hinh_slideshow = 'quan_li_hinh_anh/'.'hinh_slideshow/'.$slideshow->id.'/'.$file_name;
             $slideshow->save();
        }

        return Redirect::route('admin.slideshow')->with('success','Thêm dữ liệu thành công');
    }

     public function get_slideshow_sua($id){
        $slideshow = slideshow::find($id);
        return view('admin.hinhanh.slideshow-sua')->with('slideshow',$slideshow);
    }

    public function post_slideshow_sua(Request $request, $id){
        $rule = [
            'hinh-slideshow'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'hinh-slideshow'=> 'Hình ảnh',
            'tieu-de' => 'tiêu đề',
            'link'=>'link', 
        ];

        $request->validate($rule, $message, $attribute);

        $hinh_anh = $request->file('hinh-slideshow');
       
        $tieu_de = $request->input('tieu-de');
        
        $link = $request->input('link');
        $hien = $request->has('check-hien');
        $noi_bat = $request->has('check-noi-bat');
        if($request->hasFile('hinh-slideshow'))
        {
            $date = Carbon::now();
            $date = $date->format('dmy');
            $slideshow = slideshow::find($id);
            $slideshow->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'hien'=>$hien,
                    'noi_bat'=>$noi_bat,
                    'hinh_slideshow'=>$hinh_anh,
            ]);
            $file_name = $date.$hinh_anh->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $hinh_anh->move(public_path('quan_li_hinh_anh/'.'hinh_slideshow/'.$slideshow->id.'/'), $file_name);
            $slideshow->hinh_slideshow = 'quan_li_hinh_anh/'.'hinh_slideshow/'.$slideshow->id.'/'.$file_name;
             $slideshow->save();
        }
        else {
            $slideshow = slideshow::find($id);
            $slideshow->fill([
                    'link'=>$link,
                    'tieu_de'=>$tieu_de,
                    'hien'=>$hien,
                    'noi_bat'=>$noi_bat,
            ]);
             $slideshow->save();
        }

        return Redirect::route('admin.slideshow')->with('success','Sửa dữ liệu thành công');
    }

    public function slideshow_xoa($id){
        $slideshow = slideshow::find($id);
        $slideshow->delete();
        return Redirect::route('admin.slideshow')->with('success','Xóa dữ liệu thành công');
    }

    public function slideshow_noi_bat(Request $request,$id){
        $check = $request->check;
        $slideshow = slideshow::find($id);
        if($check=="true"){
            $slideshow->fill([
                'noi_bat'=>1
            ]);
        }else{
            $slideshow->fill([
                'noi_bat'=>0
            ]);
        }
        $slideshow->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

    public function slideshow_hien(Request $request,$id){
        $check = $request->check;
        $slideshow = slideshow::find($id);
        if($check=="true"){
            $slideshow->fill([
                'hien'=>1
            ]);
        }else{
            $slideshow->fill([
                'hien'=>0
            ]);
        }
        $slideshow->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }
}
