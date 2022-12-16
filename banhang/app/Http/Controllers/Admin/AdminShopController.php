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
use App\Models\thong_tin_shop;

class AdminShopController extends Controller
{
    public function thong_tin_shop(){
        $shop = thong_tin_shop::orderBy('id')->first();
        return view('admin.thongtinshop.thong-tin-cua-shop')->with('shop',$shop);
    }

    public function thong_tin_shop_them(Request  $request){
        $rule = [
            'ten-shop' => 'required',
            'so-dien-thoai'=>'required|numeric',
            'zalo' => 'numeric',
            'email' => 'required|email',
            'dia-chi' => 'required',
            'thoi-gian-mo' => 'required|date_format:H:i',
            'thoi-gian-dong' => 'required|date_format:H:i',
            'noidung' =>'',
            'nhung-ban-do' => '',
            
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
            'email' => 'Vui lòng nhập đúng định dạng email',
            'date' => 'Vui lòng nhập đúng thời gian',
            'date_format' => 'Vui lòng nhập đúng định dạng giờ:phút' 
        ];
        $attribute = [
            'ten-shop' => 'Tên shop',
            'so-dien-thoai'=>'Số điện thoại',
            'zalo' => 'zalo',
            'email' => 'Email',
            'dia-chi' => 'Địa chỉ',
            'thoi-gian-mo' => 'Thời gian mở',
            'thoi-gian-dong' => 'Thời gian đóng',
            'noidung' =>'Nội dung',
            'nhung-ban-do' => 'Bản đồ',
         
        ];

        $request->validate($rule, $message, $attribute);

        $ten_shop = $request->input('ten-shop');
        $so_dien_thoai = $request->input('so-dien-thoai');
        $zalo = $request->input('zalo');
        $email = $request->input('email');
        $dia_chi = $request->input('dia-chi');
        $thoi_gian_mo = $request->input('thoi-gian-mo');
        $thoi_gian_dong = $request->input('thoi-gian-dong');
        $noi_dung  = $request->input('noidung');
        $ban_do = $request->input('nhung-ban-do');
        $shop = new thong_tin_shop;
        $shop->fill([
            'ten_shop'=>$ten_shop,
            'so_dien_thoai'=>$so_dien_thoai,
            'zalo'=>$zalo,
            'email'=>$email,
            'dia_chi'=>$dia_chi,
            'thoi_gian_mo'=>$thoi_gian_mo,
            'thoi_gian_dong'=>$thoi_gian_dong,
            'noi_dung'=>$noi_dung,
            'ban_do'=>$ban_do,
        ]);
        $shop->save();
        return Redirect::route('admin.thong-tin-shop')->with('success','Thêm dữ liệu thành công');
        
    }

     public function thong_tin_shop_sua(Request  $request, $id){
        $rule = [
            'ten-shop' => 'required',
            'so-dien-thoai'=>'required|numeric',
            'zalo' => 'numeric',
            'email' => 'required|email',
            'dia-chi' => 'required',
            'thoi-gian-mo' => 'required|date_format:H:i',
            'thoi-gian-dong' => 'required|date_format:H:i',
            'noidung' =>'',
            'nhung-ban-do' => '',
            
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
            'email' => 'Vui lòng nhập đúng định dạng email',
            'date' => 'Vui lòng nhập đúng thời gian',
            'date_format' => 'Vui lòng nhập đúng định dạng giờ:phút' 
        ];
        $attribute = [
            'ten-shop' => 'Tên shop',
            'so-dien-thoai'=>'Số điện thoại',
            'zalo' => 'zalo',
            'email' => 'Email',
            'dia-chi' => 'Địa chỉ',
            'thoi-gian-mo' => 'Thời gian mở',
            'thoi-gian-dong' => 'Thời gian đóng',
            'noidung' =>'Nội dung',
            'nhung-ban-do' => 'Bản đồ',
         
        ];

        $request->validate($rule, $message, $attribute);

        $ten_shop = $request->input('ten-shop');
        $so_dien_thoai = $request->input('so-dien-thoai');
        $zalo = $request->input('zalo');
        $email = $request->input('email');
        $dia_chi = $request->input('dia-chi');
        $thoi_gian_mo = $request->input('thoi-gian-mo');
        $thoi_gian_dong = $request->input('thoi-gian-dong');
        $noi_dung  = $request->input('noidung');
        $ban_do = $request->input('nhung-ban-do');
        $shop = thong_tin_shop::find($id);
        $shop->fill([
            'ten_shop'=>$ten_shop,
            'so_dien_thoai'=>$so_dien_thoai,
            'zalo'=>$zalo,
            'email'=>$email,
            'dia_chi'=>$dia_chi,
            'thoi_gian_mo'=>$thoi_gian_mo,
            'thoi_gian_dong'=>$thoi_gian_dong,
            'noi_dung'=>$noi_dung,
            'ban_do'=>$ban_do,
        ]);
        $shop->save();

        return Redirect::route('admin.thong-tin-shop')->with('success','Sửa dữ liệu thành công');
        
    }


}
