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
use App\Models\trang_tinh;

class AdminTrangTinhController extends Controller
{
    //footer
    function footer(){
        $footer = trang_tinh::where('loai','=',1)->first();
        return view('admin.trangtinh.footer.footer')->with('footer',$footer);
    }

    function footer_them(Request $request){
        $rule = [
            'tieu-de' => 'required',
            'noi-dung'=>'required',    
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
        ];
        $attribute = [
            'tieu-de' => 'tiêu đề',
            'noi-dung'=>'Nội dung', 
        ];

        $request->validate($rule, $message, $attribute);
        $tieu_de = $request->input('tieu-de');
        $noi_dung = $request->input('noi-dung');
        $footer = new trang_tinh;
        $footer->fill([
            'tieu_de'=>$tieu_de,
            'noi_dung'=>$noi_dung,
            'loai'=>1,
        ]);
        $footer->save();
        return Redirect::route('admin.footer')->with('success','Thêm dữ liệu thành công');
    }

     function footer_sua(Request $request, $id){
        $rule = [
            'tieu-de' => 'required',
            'noi-dung'=>'required',    
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
        ];
        $attribute = [
            'tieu-de' => 'tiêu đề',
            'noi-dung'=>'Nội dung', 
        ];

        $request->validate($rule, $message, $attribute);
        $tieu_de = $request->input('tieu-de');
        $noi_dung = $request->input('noi-dung');
        $footer =  trang_tinh::where('loai','=',1)->find($id);
        $footer->fill([
            'tieu_de'=>$tieu_de,
            'noi_dung'=>$noi_dung,
            'loai'=>1,
        ]);
        $footer->save();
        return Redirect::route('admin.footer')->with('success','Sửa dữ liệu thành công');
    }

    function footer_xoa($id){
        $footer = trang_tinh::where('loai','=',1)->find($id);
        $footer->delete();
        return Redirect::route('admin.footer')->with('success','Xóa thành công');
    }

    //Chính sách
    function chinh_sach(){
        $chinh_sach = trang_tinh::where('loai','=',2)->first();
        return view('admin.trangtinh.chinhsach.chinh-sach')->with('chinh_sach',$chinh_sach);
    }

    function chinh_sach_them(Request $request){
        $rule = [
            'tieu-de' => 'required',
            'noi-dung'=>'required',    
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
        ];
        $attribute = [
            'tieu-de' => 'tiêu đề',
            'noi-dung'=>'Nội dung', 
        ];

        $request->validate($rule, $message, $attribute);
        $tieu_de = $request->input('tieu-de');
        $noi_dung = $request->input('noi-dung');
        $chinh_sach = new trang_tinh;
        $chinh_sach->fill([
            'tieu_de'=>$tieu_de,
            'noi_dung'=>$noi_dung,
            'loai'=>2,
        ]);
        $chinh_sach->save();
        return Redirect::route('admin.chinh-sach')->with('success','Thêm dữ liệu thành công');
    }

     function chinh_sach_sua(Request $request, $id){
        $rule = [
            'tieu-de' => 'required',
            'noi-dung'=>'required',    
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
        ];
        $attribute = [
            'tieu-de' => 'tiêu đề',
            'noi-dung'=>'Nội dung', 
        ];

        $request->validate($rule, $message, $attribute);
        $tieu_de = $request->input('tieu-de');
        $noi_dung = $request->input('noi-dung');
        $chinh_sach =  trang_tinh::where('loai','=',2)->find($id);
        $chinh_sach->fill([
            'tieu_de'=>$tieu_de,
            'noi_dung'=>$noi_dung,
            'loai'=>2,
        ]);
        $chinh_sach->save();
        return Redirect::route('admin.chinh-sach')->with('success','Sửa dữ liệu thành công');
    }

    function chinh_sach_xoa($id){
        $chinh_sach = trang_tinh::where('loai','=',2)->find($id);
        $chinh_sach->delete();
        return Redirect::route('admin.chinh-sach')->with('success','Xóa thành công');
    }

    //slogan
    function slogan(){
        $slogan = trang_tinh::where('loai','=',3)->first();
        return view('admin.trangtinh.slogan.slogan')->with('slogan',$slogan);
    }

    function slogan_them(Request $request){
        $rule = [
            'noi-dung'=>'required',    
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
        ];
        $attribute = [
            'noi-dung'=>'Nội dung', 
        ];

        $request->validate($rule, $message, $attribute);
        $noi_dung = $request->input('noi-dung');
        $slogan = new trang_tinh;
        $slogan->fill([
            'noi_dung'=>$noi_dung,
            'loai'=>3,
        ]);
        $slogan->save();
        return Redirect::route('admin.slogan')->with('success','Thêm dữ liệu thành công');
    }

     function slogan_sua(Request $request, $id){
        $rule = [
            'noi-dung'=>'required',    
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
        ];
        $attribute = [
            'noi-dung'=>'Nội dung', 
        ];

        $request->validate($rule, $message, $attribute);
        $noi_dung = $request->input('noi-dung');
        $slogan =  trang_tinh::where('loai','=',3)->find($id);
        $slogan->fill([
            'noi_dung'=>$noi_dung,
            'loai'=>3,
        ]);
        $slogan->save();
        return Redirect::route('admin.slogan')->with('success','Sửa dữ liệu thành công');
    }

    function slogan_xoa($id){
        $slogan = trang_tinh::where('loai','=',3)->find($id);
        $slogan->delete();
        return Redirect::route('admin.slogan')->with('success','Xóa thành công');
    }
}
