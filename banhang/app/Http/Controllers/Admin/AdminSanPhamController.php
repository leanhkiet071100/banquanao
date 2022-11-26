<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\sanpham_chitiet;
use App\Models\sanpham_hinhanh;
use App\Http\Requests\StoresanphamRequest;
use App\Http\Requests\UpdatesanphamRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AdminSanPhamController extends Controller
{
    public function san_pham(){
        $lssanpham = sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                    ->select('sanphams.id','loai_san_phams.ten_loai_san_pham','sanphams.ten_san_pham','sanphams.gia','sanphams.so_luong_kho','sanphams.moi','sanphams.noi_bat','sanphams.hien')
                    ->get();
        //dd($lssanpham);
        return view('admin.sanpham.sanpham-ds')->with(['lssanpham'=>$lssanpham]);
    }

    public function get_them_san_pham(){
        $lsloaisanpham = loai_san_pham::all();
        $lsnhanhieu = nhan_hieu::all();
        return view('admin.sanpham.sanpham-them')->with(['lsloaisanpham'=>$lsloaisanpham, 'lsnhanhieu'=>$lsnhanhieu]);
    }

    public function post_them_san_pham(Request $request){
        $rule = [
            'nhanhieu_id' => 'required',
            'loaisp_id'=>'required',
            'tensp' => 'required|unique:sanphams,ten_san_pham',
            'mota' => 'required',
            'noidung' => 'required',
            'giasp' => 'required|numeric',
            'soluongkho' => 'required|numeric',
            'trongluong' => 'required|numeric',
            'sku' =>'required|numeric',
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
            //'image' => ':attribute không đúng định dạng',
            'mimes' => ':attribute không đúng định dạng',

        ];
        $attribute = [
            'nhanhieu_id' => 'nhãn hiệu',
            'loaisp_id'=>'loại sản phẩm',
            'tensp' => 'Tên sản phẩm',
            'mota' => 'Mô tả',
            'noidung' => 'Nội dung',
            'giasp' => 'Giá sản phẩm',
            'soluongkho' => 'Số lượng kho',
            'trongluong' => 'Trọng lượng',
            'sku' =>'SKU',
         
        ];

        $request->validate($rule, $message, $attribute);

        $nhanhieu_id = $request->input('nhanhieu_id');
        $loaisp_id = $request->input('loaisp_id');
        $tensp = $request->input('tensp');
        $mota = $request->input('mota');
        $noidung = $request->input('noidung');
        $gia = $request->input('giasp');
        $soluongkho = $request->input('soluongkho');
        $tiengiam = $request->input('giamgia');
        $trongluong = $request->input('trongluong');
        $tag = $request->input('tag');
        $SKU = $request->input('sku');

        $sanphammoi = new sanpham;
        $sanphammoi->fill([
            'ma_nhan_hieu'=> $nhanhieu_id,
            'ma_loai_san_pham'=> $loaisp_id,
            'ten_san_pham'=> $tensp,
            'mo_ta'=>$mota,
            'noi_dung'=>$noidung,
            'gia'=> $gia,
            'so_luong_kho'=> $soluongkho,
            'tien_giam'=> $tiengiam,
            'trong_luong'=> $trongluong,
            'tag'=>$tag,
            'sku'=>$SKU,
        ]);
        $sanphammoi->save();
        return Redirect::route('admin.san-pham');
    }

    public function chi_tiet_san_pham($id){
        $sanpham = sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                            ->join('nhan_hieus','nhan_hieus.id', '=','sanphams.ma_nhan_hieu')
                            ->select('sanphams.*','nhan_hieus.ten_nhan_hieu','loai_san_phams.ten_loai_san_pham')
                            ->find($id);
        return view('admin.sanpham.sanpham-chitiet')->with(['sanpham'=>$sanpham]);
    }

    public function chi_tiet_san_pham_ds($id){
        $chitietsp = sanpham_chitiet::join('sanphams','sanphams.id','=','sanpham_chitiets.ma_san_pham')
                    ->where('sanpham_chitiets.ma_san_pham','=',$id)->get();
        $idsp = $id;
        return view('admin.sanpham.chitietsanpham-ds')->with(['chitietsp'=>$chitietsp,'idsp'=>$id]);
    }

    public function chi_tiet_san_pham_hinh_anh($id){
        $sanpham = sanpham::find($id);
        $sanphamhinh = sanpham_hinhanh::where('ma_san_pham','=',$id)->get();
        return view('admin.sanpham.sanpham-hinh')->with(['sanpham'=>$sanpham,'sanphamhinh'=>$sanphamhinh]);
    }

    public function load_hinh_anh_san_pham($id){
        $sanphamhinh = sanpham_hinhanh::where('ma_san_pham','=',$id)->get();
        return response()->json(['sanphamhinh' => $sanphamhinh]);
    }
    
    public function xoa_hinh_san_pham($id){
        $hinhsp  = sanpham_hinhanh::find($id);
        $hinhsp->delete();
        return response()->json([
            'status'=>200,
            'mess'=> 'Xóa thành công',
        ]);
    }
    
    public function get_chi_tiet_san_pham_them($id){
        $sanpham = sanpham::find($id);
        return view('admin.sanpham.chitietsanpham-them')->with(['sanpham'=>$sanpham]);
    }

    public function them_hinh_san_pham(Request $request){
        $validator = Validator::make($request->all(), [
            'hinhsp' => 'required',
        ], $messages = [
            'required' => 'Chưa có hình ảnh',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{
            $idsp = $request->idsp;
            $hinhsp = $request->file('hinhsp');
            //mảng kiển tra hình
            $allowedfileExtension=['jpg','png', 'jpeg', 'svg', 'PNG', 'JPG', 'JPEG','SVG'];
            if($hinhsp!=null){
                foreach($hinhsp as $key=>$value){
                    //lấy đuôi file
                    $typefile = $value->getClientOriginalExtension();
                    $check=in_array($typefile,$allowedfileExtension);
                    if(!$check)
                    {
                        return response()->json([
                            'status'=>200,
                            'mess'=>'Đây không phải hình ảnh',
                        ]);
                    }
                    else{
                        $file_name = time().Str::random(10).'.'.$value->getClientOriginalExtension();
                        $imagePath = $value->move(public_path('hinh_san_pham/'.$idsp.'/'), $file_name);
                        $ten_file = 'hinh_san_pham/'.$idsp.'/'.$file_name;
                        sanpham_hinhanh::create([
                            'ma_san_pham'=>$idsp,
                            'hinh_san_pham' =>$ten_file
                        ]);
                    }
                }
            }
            return response()->json([
                'status'=>200,
                'mess'=>'thêm hình ảnh thành công',
            ]);
        }
    }

}
