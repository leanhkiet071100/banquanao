<?php

namespace App\Http\Controllers;

use App\Models\nguoidung;
use App\Models\nguoidung_diachi;
use App\Models\dia_chi;
use App\Models\hoadon;
use App\Models\hoadon_chitiet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;

class NguoidungController extends Controller
{
    public function index()
    {
        return view('nguoidung.tai-khoan');
    }

    // đổi mật khẩu
    public function doi_mat_khau()
    {
         return view('nguoidung.doi-mat-khau');
    }

    public function  post_doi_mat_khau(Request $request)
    {   
        $id = Auth::user()->id;
        $nguoidung = nguoidung::find($id);
        if(Auth::user()->mat_khau == null){
        $rule = [
            'mat-khau' => ['required','min:6', 'max:50'],
            'xac-nhan-mat-khau'=>'min:6| max:50',
            'ma-xac-nhan'=> 'required|max:50',
        ];
        }else{
            $rule = [
            'mat-khau' => ['required','min:6','max:50',
                function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->mat_khau)) {
                    $fail('Mật khẩu sai');
                }
                },
            ],
            'mat-khau-moi'=> 'required|min:6| max:50|different:mat-khau',
            'xac-nhan-mat-khau-moi' => 'required|min:6| max:50|same:mat-khau-moi',
            ];
        }
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'image'=> ':attribute phải là hình ảnh',
            'same' => ':attribute không trùng với mật khẩu mới',
            'different' => ':attribute phải khác mật khẩu cũ',
         
        ];
        $attribute = [
            'mat-khau' => 'mật khẩu',
            'xac-nhan-mat-khau'=>'Xác nhận mật khẩu',
            'ma-xac-nhan' => 'Ma xác nhận',
            'mat-khau-moi' => 'Mật khẩu mới',
            'xac-nhan-mat-khau-moi' => 'Xác nhận mật khẩu mới'
        ];
        $request->validate($rule, $message, $attribute);
        $mat_khau= $request->input('mat-khau');

        if(!(Hash::check($mat_khau, Auth::user()->mat_khau)))
        {
            return Redirect::back()->withErrors('mat-khau', 'Mật khẩu sai');
        }
       
        $mat_khau = $request->input('mat-khau');
        $mat_khau_moi = $request->input('mat-khau-moi');
        $xac_nhan_mat_khau_moi = $request->input('xac-nhan-mat-khau-moi');
        
        $nguoidung->update([
            'mat_khau' => Hash::make($mat_khau_moi),

        ]);
        $nguoidung->save();
        return Redirect::route('tai-khoan.doi-mat-khau')->with('success','Đổi mật khẩu thành công');
       
    }
    // kết thúc thêm mật khẩu
    //thêm địa chỉ
    public function dia_chi()
    {
        $id_nguoi_dung = Auth::user()->id;
        $dia_chi = nguoidung_diachi::where('ma_nguoi_dung','=', $id_nguoi_dung )->orderBy('mac_dinh','DESC')->get();
        return view('nguoidung.dia-chi')->with(['dia_chi'=>$dia_chi]);
    }

    public function get_dia_chi(){
        $tinh = dia_chi::where('loai','=',1)->orderBy('ten')->get();
        return view('nguoidung.form-dia-chi')->with(['tinh'=>$tinh]);
    } 

    // kết thúc thêm dịa chỉ

    public function post_dia_chi(Request $request){
        $id_nguoi_dung = Auth::user()->id;
         $validator = Validator::make($request->all(), [
            'ho_ten' => 'required|min:3|max:25',
            'so_dien_thoai' => 'required|numeric',
            'tinh' =>'required|integer',
            'huyen' =>'required|integer',
            'xa' =>'required|integer',
            'dia_chi_cu_the' =>'required',
        ], $messages = [
            'required' => ':attribute không được bỏ trống',
            'numeric'=> ':attribute phải là số',
            'min' => ':attribute không nhỏ hơn :min kí tự',
            'max' => ':attribute không lớn hơn :max kí tự',
            'integer' => 'Vui lòng chọn :attribute  ',
            
        ], $attribute = [
            'ho_ten'=> 'họ Tên',
            'so_dien_thoai' => 'Số điện thoại',
            'tinh' =>'Tỉnh',
            'huyen' =>'Huyện ',
            'xa' =>'Xã',
            'dia_chi_cu_the' =>'Địa chỉ cụ thể',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $ho_ten = $request->ho_ten;
            $so_dien_thoai = $request->so_dien_thoai;
            $tinh = $request->tinh;
            $huyen = $request->huyen;
            $xa = $request->xa;
            $dia_chi_cu_the = $request->dia_chi_cu_the;
            $mac_dinh =  $request->mac_dinh; 
            // xuất các tên tỉnh thành việt nam
            $ten_tinh = dia_chi::find($tinh);
            $ten_huyen = dia_chi::find($huyen);
            $ten_xa = dia_chi::find($xa);
            $dia_chi_nguoi_dung = new nguoidung_diachi;
            $dia_chi_nguoi_dung->fill([
                'ma_nguoi_dung'=>$id_nguoi_dung,
                'tinh'=>$ten_tinh->ten,
                'huyen'=>$ten_huyen->ten,
                'xa'=>$ten_xa->ten,
                'ho_ten'=>$ho_ten,
                'so_dien_thoai'=> $so_dien_thoai,
                'dia_chi_cu_the'=> $dia_chi_cu_the,
                'trang_thai'=> 1,
            ]);
            $dia_chi_nguoi_dung->save();
            if($mac_dinh == "true"){
                $dia_chi_mac_dinh = nguoidung_diachi::where('ma_nguoi_dung', $id_nguoi_dung)
                                    ->where('mac_dinh',1)->update(['mac_dinh'=>0]);
                $dia_chi_nguoi_dung->update(['mac_dinh'=>1]);
            }
            return response()->json([
                'status'=>200,
                'mess'=>'thêm thành công',
            ]);
        }


    }


    // sửa địa chỉ
    public function get_dia_chi_sua($id){
        $dia_chi = nguoidung_diachi::find($id);
        $tinh = dia_chi::where('loai','=',1)->orderBy('ten')->get();
        $id_tinh = dia_chi::where('ten','=',$dia_chi->tinh)->first()->id;

        $id_huyen = dia_chi::where('ten','=',$dia_chi->huyen)->first()->id;
        $id_xa = dia_chi::where('ten','=',$dia_chi->xa)->first()->id;
        return view('nguoidung.form-dia-chi-sua')->with(['tinh'=>$tinh,'dia_chi'=>$dia_chi,'id_tinh'=>$id_tinh,'id_huyen'=>$id_huyen,'id_xa'=>$id_xa]);

    } 

    public function post_dia_chi_sua(Request $request, $id){
        $id_nguoi_dung = Auth::user()->id;
         $validator = Validator::make($request->all(), [
            'ho_ten' => 'required|min:3|max:25',
            'so_dien_thoai' => 'required|numeric',
            'tinh' =>'required',
            'huyen' =>'required',
            'xa' =>'required',
            'dia_chi_cu_the' =>'required',
        ], $messages = [
            'required' => ':attribute không được bỏ trống',
            'numeric'=> ':attribute phải là số',
            'min' => ':attribute không nhỏ hơn :min kí tự',
            'max' => ':attribute không lớn hơn :max kí tự',
            'integer' => 'Vui lòng chọn :attribute  ',
            
        ], $attribute = [
            'ho_ten'=> 'họ Tên',
            'so_dien_thoai' => 'Số điện thoại',
            'tinh' =>'Tỉnh',
            'huyen' =>'Huyện ',
            'xa' =>'Xã',
            'dia_chi_cu_the' =>'Địa chỉ cụ thể',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $ho_ten = $request->ho_ten;
            $so_dien_thoai = $request->so_dien_thoai;
            $tinh = $request->tinh;
            $huyen = $request->huyen;
            $xa = $request->xa;
            $dia_chi_cu_the = $request->dia_chi_cu_the;
            $mac_dinh =  $request->mac_dinh; 
            // xuất các tên tỉnh thành việt nam
            $ten_tinh = dia_chi::find($tinh);
            $ten_huyen = dia_chi::find($huyen);
            $ten_xa = dia_chi::find($xa);

            $dia_chi_nguoi_dung = nguoidung_diachi::find($id);
 
            $dia_chi_nguoi_dung->fill([
                'ma_nguoi_dung'=>$id_nguoi_dung,
                'tinh'=>$ten_tinh->ten,
                'huyen'=>$ten_huyen->ten,
                'xa'=>$ten_xa->ten,
                'ho_ten'=>$ho_ten,
                'so_dien_thoai'=> $so_dien_thoai,
                'dia_chi_cu_the'=> $dia_chi_cu_the,
                'trang_thai'=> 1,
            ]);
            $dia_chi_nguoi_dung->save();
            
            if($mac_dinh == "true"){ 
                 $dia_chi_mac_dinh = nguoidung_diachi::where('ma_nguoi_dung', $id_nguoi_dung)->where('mac_dinh',1)
                                                    ->where('id','!=',$id)->update(['mac_dinh'=>0]);
                $dia_chi_nguoi_dung->update(['mac_dinh'=>1]); 
            }else{
                $dia_chi_nguoi_dung->update(['mac_dinh'=>0]);
            }
            return $dia_chi_nguoi_dung;
            return response()->json([
                'status'=>200,
                'mess'=>'Sửa thành công',
            ]);
        }


    }
    //kết thúc sửa dịa chỉ

    // thay đổi tìa khoản
    public function thay_doi_tai_khoan(Request $request){
         $rule = [
            'ho-ten' => 'required|min:6| max:25',
            'anh-dai-dien'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $message =[
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min', // lớn hơn  (không phải độ dài)
            'max' => ':attribute phải nhỏ hơn :max', // nhỏ hơn
            'numeric' => ':attribute phải là số',
            'image'=> ':attribute phải là hình ảnh',
            'mimes' => 'hình ảnh phải có đuổi là: jpeg,png,jpg,gif,svg',
        ];
        $attribute = [
            'ho-ten' => 'Họ tên',
            'anh-dai-dien'=>'Ảnh đại diện',
            
        ];

        $request->validate($rule, $message, $attribute);
        $ho_ten = $request->input('ho-ten');
        $anh_dai_dien = $request->file('anh-dai-dien');
        $id = Auth::user()->id;
         $nguoidung = nguoidung::find($id);
         $nguoidung->update([
                'ten' => $ho_ten,
            ]);
            
        if($request->hasFile('anh-dai-dien')){ 
            if(Auth::user()->hinh_dai_dien != null)
            {
                unlink($nguoidung->hinh_dai_dien);
            }
            $file_name = $anh_dai_dien->getClientoriginalName();
            // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $anh_dai_dien->move(public_path('hinh_nguoi_dung/'.$id), $file_name);
            $nguoidung->hinh_dai_dien = 'hinh_nguoi_dung/'.$id.'/'.$file_name;
            $nguoidung->save();
        }
        $nguoidung->save();

        return Redirect::route('tai-khoan.tai-khoan')->with('success','Sửa thông tin tài khoản thành công');
        
    }

     public function thiet_lap_dia_chi(Request $request){
        $id_nguoi_dung = Auth::user()->id;
        $id_dia_chi = $request->id_dia_chi;
        $dia_chi = nguoidung_diachi::where('ma_nguoi_dung', $id_nguoi_dung)
                                    ->where('mac_dinh',1)->update(['mac_dinh'=>0]);
        $dia_chi_mac_dinh = nguoidung_diachi::where('ma_nguoi_dung', $id_nguoi_dung)->find($id_dia_chi)->update(['mac_dinh'=>1]);

        return response()->json([
                        'status'=>200,
                        'mess'=>'Thiết lập thành công',
                    ]);
    }

    public function get_load_huyen(Request $request){
      $parent_id = $request->parent_id;
      $lshuyen = dia_chi::where('loai',2)->where('parent_id',$parent_id)->orderBy('ten')->get();
      return response()->json(['data' => $lshuyen]);
    }

    public function get_load_xa(Request $request){
      $parent_id = $request->parent_id;
      $lsxa = dia_chi::where('loai',3)->where('parent_id',$parent_id)->orderBy('ten')->get();
      return response()->json(['data' => $lsxa]);
    }
    
    // đăng xuất
    public function logout_user(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('dang-nhap');
    }


    // quản lí đơn hàng
    public function don_hang(Request $request){
        $iduser = Auth::user()->id;
        $don_hang = hoadon::where('ma_nguoi_dung','=',$iduser)
                            ->orderByRaw('id DESC')
                            ->get();
        $don_hang_chi_tiet = hoadon_chitiet::join('sanphams','sanphams.id', '=','hoadon_chitiets.ma_san_pham')
                            ->select('hoadon_chitiets.*','sanphams.ten_san_pham','sanphams.gia','sanphams.hinh_anh','sanphams.tien_giam')
                            ->get();
        return view('nguoidung.donhang.don-hang-all')->with(['don_hang'=>$don_hang,'don_hang_chi_tiet'=>$don_hang_chi_tiet]);
    }
    public function don_hang_cho_xac_nhan(Request $request){
        $iduser = Auth::user()->id;
        $don_hang = hoadon::where('ma_nguoi_dung','=',$iduser)->where('trang_thai','=',1)
                            ->orderByRaw('id DESC')->get();
        $don_hang_chi_tiet = hoadon_chitiet::join('sanphams','sanphams.id', '=','hoadon_chitiets.ma_san_pham')
                            ->select('hoadon_chitiets.*','sanphams.ten_san_pham','sanphams.gia','sanphams.hinh_anh','sanphams.tien_giam')
                            ->get();
        return view('nguoidung.donhang.don-hang-cho-xac-nhan')->with(['don_hang'=>$don_hang,'don_hang_chi_tiet'=>$don_hang_chi_tiet]);
    }
    public function don_hang_dang_giao(Request $request){
        $iduser = Auth::user()->id;
        $don_hang = hoadon::where('ma_nguoi_dung','=',$iduser)->where('trang_thai','=',3)
                            ->orderByRaw('id DESC')->get();
        $don_hang_chi_tiet = hoadon_chitiet::join('sanphams','sanphams.id', '=','hoadon_chitiets.ma_san_pham')
                            ->select('hoadon_chitiets.*','sanphams.ten_san_pham','sanphams.gia','sanphams.hinh_anh','sanphams.tien_giam')
                            ->get();
        return view('nguoidung.donhang.don-hang-dang-giao')->with(['don_hang'=>$don_hang,'don_hang_chi_tiet'=>$don_hang_chi_tiet]);
    }
    public function don_hang_hoan_thanh(Request $request){
        $iduser = Auth::user()->id;
        $don_hang = hoadon::where('ma_nguoi_dung','=',$iduser)->where('trang_thai','=',4)
                            ->orderByRaw('id DESC')->get();
        $don_hang_chi_tiet = hoadon_chitiet::join('sanphams','sanphams.id', '=','hoadon_chitiets.ma_san_pham')
                            ->select('hoadon_chitiets.*','sanphams.ten_san_pham','sanphams.gia','sanphams.hinh_anh','sanphams.tien_giam')
                            ->get();
        return view('nguoidung.donhang.don-hang-hoan-thanh')->with(['don_hang'=>$don_hang,'don_hang_chi_tiet'=>$don_hang_chi_tiet]);
    }
    public function don_hang_huy(Request $request){
        $iduser = Auth::user()->id;
        $don_hang = hoadon::where('ma_nguoi_dung','=',$iduser)->where('trang_thai','=',0)
                            ->orderByRaw('id DESC')->get();
        $don_hang_chi_tiet = hoadon_chitiet::join('sanphams','sanphams.id', '=','hoadon_chitiets.ma_san_pham')
                            ->select('hoadon_chitiets.*','sanphams.ten_san_pham','sanphams.gia','sanphams.hinh_anh','sanphams.tien_giam')
                            ->get();
        return view('nguoidung.donhang.don-hang-huy')->with(['don_hang'=>$don_hang,'don_hang_chi_tiet'=>$don_hang_chi_tiet]);
    }
    public function don_hang_tra_hang(Request $request){
        $iduser = Auth::user()->id;
        $don_hang = hoadon::where('ma_nguoi_dung','=',$iduser)->where('trang_thai','=',5)
                            ->orderByRaw('id DESC')->get();
        $don_hang_chi_tiet = hoadon_chitiet::join('sanphams','sanphams.id', '=','hoadon_chitiets.ma_san_pham')
                            ->select('hoadon_chitiets.*','sanphams.ten_san_pham','sanphams.gia','sanphams.hinh_anh','sanphams.tien_giam')
                            ->get();
        return view('nguoidung.donhang.don-hang-tra-hang')->with(['don_hang'=>$don_hang,'don_hang_chi_tiet'=>$don_hang_chi_tiet]);
    }
    public function don_hang_van_chuyen(Request $request){
        $iduser = Auth::user()->id;
        $don_hang = hoadon::where('ma_nguoi_dung','=',$iduser)->where('trang_thai','=',2)
                            ->orderByRaw('id DESC')->get();
        $don_hang_chi_tiet = hoadon_chitiet::join('sanphams','sanphams.id', '=','hoadon_chitiets.ma_san_pham')
                            ->select('hoadon_chitiets.*','sanphams.ten_san_pham','sanphams.gia','sanphams.hinh_anh','sanphams.tien_giam')
                            ->get();
        return view('nguoidung.donhang.dong-hang-van-chuyen')->with(['don_hang'=>$don_hang,'don_hang_chi_tiet'=>$don_hang_chi_tiet]);
    }
    // kết thúc quản lí hóa đơn hàng
    

}
