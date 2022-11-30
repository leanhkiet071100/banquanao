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
use App\Models\loai_san_pham;
use Validator;

class AdminLoaiSanPhamController extends Controller
{
    public function get_loai_san_pham(){
        $lsloaisanpham = loai_san_pham::all();
        return  view('admin.loaisanpham.loaisanpham-ds');
    }
    public function load_loai_san_pham(){
        $lsloaisanpham = loai_san_pham::all();
        return response()->json(['lsloaisanpham' => $lsloaisanpham]);
    }

    public function get_them_loai_san_pham(){
        $output = '';
        return  view('admin.loaisanpham.loaisanpham-them');
    }

    public function post_them_loai_san_pham(Request $request){
        $validator = Validator::make($request->all(), [
            'ten' => 'required|unique:loai_san_phams,ten_loai_san_pham',
        ], $messages = [
            'required' => 'Tên loại sản phẩm không được bỏ trống',
            'unique' => 'Tên loại sản phẩm đã tồn tại',
        ]);

         if($validator->fails())
        {
            
            return response()->json([
              'status'=>400,
            'errors'=>$validator->messages(),
             ]);
        }
        else{
             $tenloaisanpham = $request->ten;

                $loaisanpham = new loai_san_pham;
                $loaisanpham->fill([
                    'ten_loai_san_pham'=>$tenloaisanpham,
                    
                ]);
                $loaisanpham->save();
            return response()->json([
                'status'=>200,
                'mess'=>'thêm thành công',
             ]);;
        }

    }

    public function get_sua_loai_san_pham($id){
        $loaisp = loai_san_pham::find($id);
        return view('admin.loaisanpham.loaisanpham-sua')->with(['loaisp' => $loaisp]);
    }

    public function post_sua_loai_san_pham(Request $request, $id){
         $validator = Validator::make($request->all(), [
            'ten' => 'required|unique:loai_san_phams,ten_loai_san_pham',
        ], $messages = [
            'required' => 'Tên loại sản phẩm không được bỏ trống',
            'unique' => 'Tên loại sản phẩm đã tồn tại',
        ]);

         if($validator->fails())
        {
            
            return response()->json([
              'status'=>400,
            'errors'=>$validator->messages(),
             ]);
        }
        else{
             $tenloaisanpham = $request->ten;

                $loaisanpham = loai_san_pham::find($id);
                $loaisanpham->fill([
                    'ten_loai_san_pham'=>$tenloaisanpham,
                    
                ]);
                $loaisanpham->save();
                return response()->json([
                    'status'=>200,
                    'mess'=>'sửa thành công',
                ]);;
        }

    }

    public function xoa_loai_san_pham($id){
        $loaisanpham  = loai_san_pham::find($id);
        $loaisanpham->delete();
        return response()->json([
            'status'=>200,
            'mess'=> 'Xóa thành công',
        ]);

    }

    public function loai_san_pham_hien(Request $request,$id){
        $check = $request->check;
        $loaisanpham = loai_san_pham::find($id);
        if($check=="true"){
            $loaisanpham->fill([
                'hien'=>1
            ]);
        }else{
            $loaisanpham->fill([
                'hien'=>0
            ]);
        }
        $loaisanpham->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

     public function loai_san_pham_moi(Request $request,$id){
        $check = $request->check;
        $loaisanpham = loai_san_pham::find($id);
        if($check=="true"){
            $loaisanpham->fill([
                'moi'=>1
            ]);
        }else{
            $loaisanpham->fill([
                'moi'=>0
            ]);
        }
        $loaisanpham->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

     public function loai_san_pham_noi_bat(Request $request,$id){
        $check = $request->check;
        $loaisanpham = loai_san_pham::find($id);
        if($check=="true"){
            $loaisanpham->fill([
                'noi_bat'=>1
            ]);
        }else{
            $loaisanpham->fill([
                'noi_bat'=>0
            ]);
        }
        $loaisanpham->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

   
}
