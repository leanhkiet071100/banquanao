<?php

namespace App\Http\Controllers\Admin;

use App\Models\baiviet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Validator;

class AdminBaiVietController extends Controller
{
     //Bài viết
    public function bai_viet(){
        $data = baiviet::orderBy('created_at','DESC')->get();
        //dd($data);
        //dd(request()->search);
        $key = request()->search;

        if($key == null)
        {  
            $lsbaiviet = baiviet::orderBy('created_at','DESC')
                    ->paginate(5);
            
        }else{
            $lsbaiviet = baiviet::where('tieu_de','like','%'.$key.'%')
                    ->orderBy('created_at','DESC')
                    ->paginate(5);
        }
        return view('admin.baiviet.baiviet-ds')->with(['lsbaiviet'=>$lsbaiviet]);
    }

    //thêm Bài viết
    public function get_them_bai_viet(){
        return view('admin.baiviet.baiviet-them');
    }

    public function post_them_bai_viet(Request $request){
        $rule = [
            'hinhbaiviet' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'loaibaiviet'=>'required',
            'tieude' => 'required',
            'phude' => '',
            'noidung' => 'required',
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute không đúng định dạng',
            'mimes' => ':attribute không đúng định dạng',

        ];
        $attribute = [
            'hinhbaiviet' => 'Hình bài viêt',
            'loaibaiviet'=>'loại bài viết',
            'phude' => 'Phụ để',
            'noidung' => 'Nội dung',
            'tieude' => 'Tiêu đề',
        ];
        $request->validate($rule, $message, $attribute);
        $hinhbaiviet = $request->file('hinhbaiviet');
        $loaibaiviet = $request->input('loaibaiviet');
        $phude = $request->input('phude');
        $noidung = $request->input('noidung');
        $baivietmoi = new baiviet;
        $tieude = $request->input('tieude');
                    $baivietmoi->fill([
                'ma_nguoi_dung'=> 1,
                'tieu_de'=> $tieude,
                'phu_de'=> $phude,
                // 'hinh_anh'=>$ten_file,
                'loai_bai_viet'=>$loaibaiviet,
                'noi_dung'=>$noidung,
                'moi'=> 1,
                'noi_bat'=> 1,
                'hien'=> 1,
         ]);
         $baivietmoi->save();
        if($hinhbaiviet != null){
            $file_name = time().Str::random(10).'.'.$hinhbaiviet->getClientOriginalExtension();
            $imagePath = $hinhbaiviet->move(public_path('hinh_bai_viet/'), $file_name);
            $ten_file = 'hinh_bai_viet/'.$file_name;
            $baiviet->hinh_anh = $ten_file;
            $baivietmoi->save();
        }
         return Redirect::route('admin.bai-viet')->with('success','Thêm thành công');

        
    }

    //chi tiết bài viết
    public function chi_tiet_bai_viet($id){
        $baiviet = baiviet::join('nguoidungs','nguoidungs.id', '=','baiviets.ma_nguoi_dung')
                            ->select('baiviets.*','nguoidungs.ten','nguoidungs.hinh_dai_dien')
                            ->find($id);
        return view('admin.baiviet.baiviet-chitiet')->with(['baiviet'=>$baiviet]);
    }

    //sửa bài viết
     public function get_bai_viet_sua($id){
        $baiviet = baiviet::find($id);
        return view('admin.baiviet.baiviet-sua')->with(['baiviet'=>$baiviet]);
    }

    public function post_bai_viet_sua(Request $request,$id){
         $rule = [
            'hinhbaiviet' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'loaibaiviet'=>'required',
            'tieude' => 'required',
            'phude' => '',
            'noidung' => 'required',
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute không đúng định dạng',
            'mimes' => ':attribute không đúng định dạng',

        ];
        $attribute = [
            'hinhbaiviet' => 'Hình bài viêt',
            'loaibaiviet'=>'loại bài viết',
            'phude' => 'Phụ để',
            'noidung' => 'Nội dung',
            'tieude' => 'Tiêu đề',
        ];
        $request->validate($rule, $message, $attribute);
        $hinhbaiviet = $request->file('hinhbaiviet');
        $loaibaiviet = $request->input('loaibaiviet');
        $phude = $request->input('phude');
        $noidung = $request->input('noidung');
        $tieude = $request->input('tieude');
        $baiviet = baiviet::find($id);
        $baiviet->fill([
                'ma_nguoi_dung'=> 1,
                'tieu_de'=> $tieude,
                'phu_de'=> $phude,
                'loai_bai_viet'=>$loaibaiviet,
                'noi_dung'=>$noidung,
                'moi'=> 1,
                'noi_bat'=> 1,
                'hien'=> 1,
            ]);
          
        if($hinhbaiviet != null){
            $file_name = time().Str::random(10).'.'.$hinhbaiviet->getClientOriginalExtension();
            $imagePath = $hinhbaiviet->move(public_path('hinh_bai_viet/'), $file_name);
            $ten_file = 'hinh_bai_viet/'.$file_name;
            $baiviet->hinh_anh = $ten_file;
            $baiviet->save();
        }
        $baiviet->save();
        return Redirect::route('admin.bai-viet')->with('success','sửa thành công');
    }
    
    //xóa bài viết
    public function bai_viet_xoa($id){
        $baiviet = baiviet::find($id);
        $baiviet->delete();
        return  Redirect::route('admin.bai-viet')->with('success','Xóa thành công');
    }

    // radio

    public function bai_viet_hien(Request $request,$id){
        $check = $request->check;
        $baiviet = baiviet::find($id);
        if($check=="true"){
            $baiviet->fill([
                'hien'=>1
            ]);
        }else{
            $baiviet->fill([
                'hien'=>0
            ]);
        }
        $baiviet->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

    public function bai_viet_moi(Request $request,$id){
        $check = $request->check;
        $baiviet = baiviet::find($id);
        if($check=="true"){
            $baiviet->fill([
                'moi'=>1
            ]);
        }else{
            $baiviet->fill([
                'moi'=>0
            ]);
        }
        $baiviet->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

    public function bai_viet_noi_bat(Request $request,$id){
        $check = $request->check;
        $baiviet = baiviet::find($id);
        if($check=="true"){
            $baiviet->fill([
                'noi_bat'=>1
            ]);
        }else{
            $baiviet->fill([
                'noi_bat'=>0
            ]);
        }
        $baiviet->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }
}
