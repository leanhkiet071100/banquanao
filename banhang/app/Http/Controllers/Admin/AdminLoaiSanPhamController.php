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
    public function __construct()
    {
       // $this->middleware('auth')->only('show');
    }
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
            //chuyển chữ hoa thành chữ thường
            //ucfirst chuyển chữ cái đầu thành hoa
            //strtoupper chuyển chuỗi thành chữ hoa
            //ucwords chuyển mỗi chữ cái đầu của mỗi từ thành hoa
            $chuthuong = strtolower($tenloaisanpham);
            //thay thế khoảng trắng
            $str = $this->vn_to_str($chuthuong);
            
            $loaisanpham = new loai_san_pham;
                $loaisanpham->fill([
                    'ten_loai_san_pham'=>$tenloaisanpham,
                    'tag_loai_san_pham'=>$str,
                    
                ]);
                $loaisanpham->save();
            return response()->json([
                'status'=>200,
                'mess'=>'thêm thành công',
             ]);
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
                ]);
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

    //hàm bỏ dầu tiếng việt
    public function vn_to_str($str){
    
        $unicode = array(
        
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        
        'd'=>'đ',
        
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        
        'i'=>'í|ì|ỉ|ĩ|ị',
        
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        
        'D'=>'Đ',
        
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        
        );
        
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        
        }
        //thay đổi dấu khoảng cách bằng '-'
        $replaced = str_replace(' ', '-', $str);
        return $replaced;
    
    }

   
}
