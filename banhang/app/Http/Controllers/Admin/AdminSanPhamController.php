<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\sanpham_chitiet;
use App\Models\sanpham_hinhanh;
use App\Models\sanpham_binhluan;
use App\Models\sanpham_binhluan_hinhanh;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Exports\XuatSanPham;
use Maatwebsite\Excel\Facades\Excel;

class AdminSanPhamController extends Controller
{
    //sản phẩm
    public function san_pham(){
        $data = sanpham::orderBy('created_at','DESC')->get();
        //dd($data);
        //dd(request()->search);
        $key = request()->search;

        if($key == null)
        {
            $lssanpham = sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                    ->select('sanphams.id','loai_san_phams.ten_loai_san_pham','sanphams.ten_san_pham','sanphams.gia','sanphams.so_luong_kho','sanphams.moi','sanphams.noi_bat','sanphams.hien','sanphams.hinh_anh')
                    ->orderBy('sanphams.created_at','DESC')
                    ->paginate(5);

        }else{
            $lssanpham = sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                    ->select('sanphams.id','loai_san_phams.ten_loai_san_pham','sanphams.ten_san_pham','sanphams.gia','sanphams.so_luong_kho','sanphams.moi','sanphams.noi_bat','sanphams.hien','sanphams.hinh_anh')
                    ->where('sanphams.ten_san_pham','like','%'.$key.'%')
                    ->orderBy('sanphams.created_at','DESC')
                    ->paginate(5);
        }
        //dd($lssanpham);
        return view('admin.sanpham.sanpham-ds')->with(['lssanpham'=>$lssanpham]);
    }

    //thêm sản phẩm
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
            // 'mota' => 'required',
            // 'noidung' => 'required',
            'giamgia'=>'numeric|max:100|min:0',
            'giasp' => 'required',
            'soluongkho' => 'required|numeric',
            'trongluong' => 'required|numeric',
            'sku' =>'required',
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
            // 'mota' => 'Mô tả',
            // 'noidung' => 'Nội dung',
            'giasp' => 'Giá sản phẩm',
            'soluongkho' => 'Số lượng kho',
            'trongluong' => 'Trọng lượng',
            'sku' =>'SKU',
            'giamgia'=>'Giảm giá',

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
        $gia = str_replace(',', '', $gia);
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
            'SKU'=>$SKU,
            'hinh_anh'=>'hinh_test/no-img.jpg'
        ]);
        $sanphammoi->save();
        return Redirect::route('admin.san-pham');
    }

    //sửa sản phẩm
    public function get_san_pham_sua($id){
        $sanpham = sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                    ->join('nhan_hieus','nhan_hieus.id','=','sanphams.ma_nhan_hieu')
                    ->select('sanphams.*','loai_san_phams.ten_loai_san_pham','nhan_hieus.ten_nhan_hieu')
                    ->find($id);
                    //dd( $sanpham);
        $lsloaisanpham = loai_san_pham::all();
        $lsnhanhieu = nhan_hieu::all();
        return view('admin.sanpham.sanpham-sua')->with(['sanpham'=>$sanpham, 'lsloaisanpham'=>$lsloaisanpham,'lsnhanhieu'=>$lsnhanhieu]);
    }

    public function post_san_pham_sua(Request $request,$id){
         $rule = [
            'nhanhieu_id' => 'required',
            'loaisp_id'=>'required',
            'tensp' => 'required|unique:sanphams,ten_san_pham',
            // 'mota' => 'required',
            // 'noidung' => 'required',
            'giamgia'=>'numeric|max:100|min:0',
            'giasp' => 'required',
            'soluongkho' => 'required|numeric',
            'trongluong' => 'required|numeric',
            'sku' =>'required',
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
            // 'mota' => 'Mô tả',
            // 'noidung' => 'Nội dung',
            'giasp' => 'Giá sản phẩm',
            'soluongkho' => 'Số lượng kho',
            'trongluong' => 'Trọng lượng',
            'sku' =>'SKU',
            'giamgia'=>'Giảm giá',

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
        $gia = str_replace(',', '', $gia);
        $sanpham = sanpham::find($id);
        $sanpham->fill([
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
            'SKU'=>$SKU,
        ]);
        $sanpham->save();
        session()->flash('success','sửa thành công');
        return Redirect::route('admin.san-pham')->with('success','sửa thành công');
    }

    public function san_pham_xoa(Request $request,$id){
        $sanpham = sanpham::find($id);
        $sanpham->delete();
        return Redirect::route('admin.san-pham')->with('success','Xóa thành công');
    }

    //chi tiết sản phẩm
    public function chi_tiet_san_pham($id){
        $sanpham = sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                            ->join('nhan_hieus','nhan_hieus.id', '=','sanphams.ma_nhan_hieu')
                            ->select('sanphams.*','nhan_hieus.ten_nhan_hieu','loai_san_phams.ten_loai_san_pham')
                            ->find($id);
        return view('admin.sanpham.sanpham-chitiet')->with(['sanpham'=>$sanpham]);
    }

    public function chi_tiet_san_pham_ds($id){
        $chitietsp = sanpham_chitiet::join('sanphams','sanphams.id','=','sanpham_chitiets.ma_san_pham')
                    ->select('sanpham_chitiets.*','sanphams.ten_san_pham')
                    ->where('sanpham_chitiets.ma_san_pham','=',$id)->get();
        $idsp = $id;
        return view('admin.sanpham.chitietsanpham-ds')->with(['chitietsp'=>$chitietsp,'idsp'=>$id]);
    }

    public function get_chi_tiet_san_pham_them($id){
        $sanpham = sanpham::find($id);
        return view('admin.sanpham.chitietsanpham-them')->with(['sanpham'=>$sanpham]);
    }

    public function post_chi_tiet_san_pham_them(Request $request,$id){
         $rule = [
            'mau' => 'required',
            'size'=>'required',
            'soluongkho' => 'required|numeric',

        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
        ];
        $attribute = [
            'mau' => 'Màu',
            'size'=>'Kích thước',
            'soluongkho' => 'Số lượng kho',

        ];

        $request->validate($rule, $message, $attribute);

        $sanpham = sanpham::find($id);
        $masp= $id;
        $mau = $request->input('mau');
        $kichthuoc = $request->input('size');
        $soluongkho = $request->input('soluongkho');
        $sanphamchitietmoi = new sanpham_chitiet;
        $sanphamchitietmoi->fill([
            'ma_san_pham'=>$masp,
            'mau'=>$mau,
            'kich_thuoc'=>$kichthuoc,
            'so_luong_kho'=>$soluongkho,
            'hien'=>1,
        ]);
        $sanphamchitietmoi->save();
        return Redirect::route('admin.chi-tiet-san-pham-ds',['id'=>$id])->with('success','Thêm thành công');
    }

    public function get_chi_tiet_san_pham_sua($id){
        $sanphamchitiet = sanpham_chitiet::join('sanphams','sanphams.id','=','sanpham_chitiets.ma_san_pham')
                    ->select('sanpham_chitiets.*','sanphams.ten_san_pham')
                    ->find($id);
        return view('admin.sanpham.chitietsanpham-sua')->with(['sanphamchitiet'=>$sanphamchitiet]);
    }

    public function post_chi_tiet_san_pham_sua(Request $request,$id){
         $rule = [
            'mau' => 'required',
            'size'=>'required',
            'soluongkho' => 'required|numeric',

        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
        ];
        $attribute = [
            'mau' => 'Màu',
            'size'=>'Kích thước',
            'soluongkho' => 'Số lượng kho',
        ];

        $request->validate($rule, $message, $attribute);
        $mau = $request->input('mau');
        $kichthuoc = $request->input('size');
        $soluongkho = $request->input('soluongkho');
        $sanphamchitietmoi = sanpham_chitiet::find($id);
        $sanphamchitietmoi->fill([
            'mau'=>$mau,
            'kich_thuoc'=>$kichthuoc,
            'so_luong_kho'=>$soluongkho,
        ]);
        $sanphamchitietmoi->save();
        return Redirect::route('admin.chi-tiet-san-pham-ds',['id'=>$sanphamchitietmoi->ma_san_pham])->with('success','Sửa thành công');
    }

    public function chi_tiet_san_pham_xoa($id){
        $sanphamchitiet = sanpham_chitiet::find($id);
        $sanphamchitiet->delete();
        return  Redirect::route('admin.chi-tiet-san-pham-ds',['id'=>$sanphamchitiet->ma_san_pham])->with('success','Xóa thành công');
    }

    public function chi_tiet_san_pham_hien(Request $request,$id){
        $check = $request->check;
        $chitietsp = sanpham_chitiet::find($id);
        if($check=="true"){
            $chitietsp->fill([
                'hien'=>1
            ]);
        }else{
            $chitietsp->fill([
                'hien'=>0
            ]);
        }
        $chitietsp->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

    //hình sản phẩm
    public function chi_tiet_san_pham_hinh_anh($id){
        $sanpham = sanpham::find($id);
        $sanphamhinh = sanpham_hinhanh::where('ma_san_pham','=',$id)->get();
        return view('admin.sanpham.sanpham-hinh')->with(['sanpham'=>$sanpham,'sanphamhinh'=>$sanphamhinh]);
    }

    //load hình sản phẩm
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

    //hình ảnh sản phẩm
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

    public function hinh_anh_san_pham(Request $request, $id){
       $hinhanhsp = $request->file('hinhanhsp');
       $allowedfileExtension=['jpg','png', 'jpeg', 'svg', 'PNG', 'JPG', 'JPEG','SVG'];
       if($hinhanhsp!=null)
       {
            $typefile = $hinhanhsp->getClientOriginalExtension();
            $check=in_array($typefile,$allowedfileExtension);
            if(!$check){
                    return response()->json([
                        'status'=>400,
                        'mess'=>'Đây không phải hình ảnh',
                    ]);
                } else{
                    $file_name = time().Str::random(10).'.'.$hinhanhsp->getClientOriginalExtension();
                    $imagePath = $hinhanhsp->move(public_path('hinh_anh_san_pham/'.$id.'/'), $file_name);
                    $ten_file = 'hinh_anh_san_pham/'.$id.'/'.$file_name;
                    $sanpham = sanpham::find($id);
                    $sanpham->hinh_anh = $ten_file;
                    $sanpham->save();
                    return response()->json([
                        'status'=>200,
                        'mess'=>'Sửa hình ảnh thành công',
                    ]);
                }
        } else {
            return response()->json([
                'status'=>400,
                'mess'=>'Không được bỏ trống hình ảnh',
            ]);
        }

    }



    // radio

    public function san_pham_hien(Request $request,$id){
        $check = $request->check;
        $sanpham = sanpham::find($id);
        if($check=="true"){
            $sanpham->fill([
                'hien'=>1
            ]);
        }else{
            $sanpham->fill([
                'hien'=>0
            ]);
        }
        $sanpham->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

    public function san_pham_moi(Request $request,$id){
        $check = $request->check;
        $sanpham = sanpham::find($id);
        if($check=="true"){
            $sanpham->fill([
                'moi'=>1
            ]);
        }else{
            $sanpham->fill([
                'moi'=>0
            ]);
        }
        $sanpham->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

    public function san_pham_noi_bat(Request $request,$id){
        $check = $request->check;
        $sanpham = sanpham::find($id);
        if($check=="true"){
            $sanpham->fill([
                'noi_bat'=>1
            ]);
        }else{
            $sanpham->fill([
                'noi_bat'=>0
            ]);
        }
        $sanpham->save();
        return response()->json([
            'status'=>200,
            'mess'=>  'sửa thành công',
        ]);
    }

    // quản lí lí bình luận bài viết
    public function binh_luan_san_pham(){
        $lsbinhluan = sanpham_binhluan::join('nguoidungs','nguoidungs.id', '=','sanpham_binhluans.ma_nguoi_dung')
                                        ->join('sanphams','sanphams.id', '=','sanpham_binhluans.ma_san_pham')
                                        ->select('sanpham_binhluans.*','nguoidungs.ten','sanphams.ten_san_pham')
                                        ->paginate(10);
        return view('admin.sanpham.sanpham-binhluan')->with(['lsbinhluan'=>$lsbinhluan]);
    }

    public function binh_luan_san_pham_hien(Request $request,$id){
        $check = $request->check;
        $baiviet = sanpham_binhluan::find($id);
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

    public function binh_luan_san_pham_xoa($id){
        $binhluan_baiviet = sanpham_binhluan::find($id);
        $binhluan_baiviet->delete();
        return  Redirect::route('admin.binh-luan-san-pham')->with('success','Xóa thành công');
    }

    public function binh_luan_san_pham_chi_tiet($id){
        $binh_luan_san_pham = sanpham_binhluan::join('nguoidungs','nguoidungs.id', '=','sanpham_binhluans.ma_nguoi_dung')
                                        ->join('sanphams','sanphams.id', '=','sanpham_binhluans.ma_san_pham')
                                        ->join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                                        ->select('sanpham_binhluans.*','nguoidungs.ten','sanphams.ten_san_pham','loai_san_phams.ten_loai_san_pham')
                                        ->where('sanpham_binhluans.id','=',$id)
                                        ->first();
        $hinh_binh_luan = sanpham_binhluan_hinhanh::where('ma_binh_luan','=',$id)->get();
        return view('admin.sanpham.sanpham-binhluan-chitiet')->with(['binh_luan_san_pham'=>$binh_luan_san_pham,
                                                                'hinh_binh_luan'=>$hinh_binh_luan,]);
    }

    public function hien_form_tra_loi_binh_luan($id){
        $binh_luan_san_pham = sanpham_binhluan::join('nguoidungs','nguoidungs.id', '=','sanpham_binhluans.ma_nguoi_dung')
                                        ->join('sanphams','sanphams.id', '=','sanpham_binhluans.ma_san_pham')
                                        ->join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                                        ->select('sanpham_binhluans.*','nguoidungs.ten','sanphams.ten_san_pham','loai_san_phams.ten_loai_san_pham','sanphams.hinh_anh')
                                        ->where('sanpham_binhluans.id','=',$id)
                                        ->first();
        return view('admin.sanpham.sanpham-binhluan-traloi')->with(['binh_luan_san_pham'=>$binh_luan_san_pham,]);
    }

    public function post_form_tra_loi_binh_luan(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'noi_dung' => 'required',
        ], $messages = [
            'required' => 'Tên nhãn hiệu không được bỏ trống',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
        $binh_luan_san_pham = sanpham_binhluan::join('nguoidungs','nguoidungs.id', '=','sanpham_binhluans.ma_nguoi_dung')
                                        ->join('sanphams','sanphams.id', '=','sanpham_binhluans.ma_san_pham')
                                        ->join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                                        ->select('sanpham_binhluans.*','nguoidungs.ten','sanphams.ten_san_pham','loai_san_phams.ten_loai_san_pham','sanphams.hinh_anh')
                                        ->where('sanpham_binhluans.id','=',$id)
                                        ->first();
        $id_user = Auth::user()->id;
        $noi_dung = $request->noi_dung;
        $ma_san_pham = $binh_luan_san_pham->ma_san_pham;
        $sanpham_binhluan = new sanpham_binhluan;
        $sanpham_binhluan->fill([
            'ma_san_pham'=> $ma_san_pham,
            'ma_nguoi_dung'=>$id_user,
            'id_binh_luan_cha'=>$id,
            'noi_dung'=>$noi_dung,
            'danh_gia'=>null,
            'hien'=>1,
            'trang_thai'=>1,
        ]);
        $sanpham_binhluan->save();
        return response()->json([
                'status' => 200,
                'mess'=>'Trả lời bình luận thành công'
                ]);
            }
    }


    // kết thúc quản lí bình luận bài viết

    public function xuat_excel(){

        return Excel::download(new XuatSanPham, 'users.xlsx');
    }


}
