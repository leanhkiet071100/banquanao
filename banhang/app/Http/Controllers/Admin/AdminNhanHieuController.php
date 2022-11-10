<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nhan_hieu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Validator;

class AdminNhanHieuController extends Controller
{
    public function fixImageNhanhiet(nhan_hieu $nhanhieu){
        if(storage::disk('public')->exists($nhanhieu->hinh_nhan_hieu))
        {
           //$user->avatar = asset('storage/'.$user->avatar);
            $user->avatar = Storage::url($nhanhieu->hinh_nhan_hieu);
        }
        else
        {
            $user->avatar = 'storage/hinhnhanhieu/no-image.png';
        }
    }

    public function get_nhan_hieu()
    {
        //xuất
        //$nhan_hieu = DB::select('select * from users where active = ?', [1]);
        $lsnhanhieu = nhan_hieu::get();
        $ouput = '';
        return view('admin.nhanhieu.nhanhieu-ds')->with(['lsnhanhieu'=>$lsnhanhieu]);
    }

    public function load_nhan_hieu(){
        $lsnhanhieu = nhan_hieu::all();
        return response()->json(['lsnhanhieu' => $lsnhanhieu]);
    }

    public function get_them_nhan_hieu(){

        $output = '';
        // $output = '<div class="row">
        //     <div class="col-md-12">
        //         <div class="main-card mb-3 card">
        //             <div class="card-body">
        //                 <form method="post" enctype="multipart/form-data">
        //                     <div class="position-relative row form-group">
        //                         <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
        //                         <div class="col-md-9 col-xl-8">
        //                             <input required name="name" id="name" placeholder="Name" type="text"
        //                                 class="form-control" value="">
        //                         </div>
        //                     </div>

        //                     <div class="position-relative row form-group mb-1">
        //                         <div class="col-md-9 col-xl-8 offset-md-2">
        //                             <a href="#" class="border-0 btn btn-outline-danger mr-1">
        //                                 <span class="btn-icon-wrapper pr-1 opacity-8">
        //                                     <i class="fa fa-times fa-w-20"></i>
        //                                 </span>
        //                                 <span>Cancel</span>
        //                             </a>

        //                             <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
        //                                 <span class="btn-icon-wrapper pr-2 opacity-8">
        //                                     <i class="fa fa-download fa-w-20"></i>
        //                                 </span>
        //                                 <span>Save</span>
        //                             </button>
        //                         </div>
        //                     </div>
        //                 </form>
        //             </div>
        //         </div>
        //     </div>
        // </div>';
        return  view('admin.nhanhieu.nhanhieu-them');
    }

    public function post_them_nhan_hieu(Request $request){
        $validator = Validator::make($request->all(), [
            'tennhanhieu' => 'required|unique:nhan_hieus,ten_nhan_hieu',
            'hinhnhanhieu' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages = [
            'required' => 'Tên nhãn hiệu không được bỏ trống',
            'image' => 'đây không phải là hình ảnh',
            'mimes' => 'hình ảnh phải có đuổi là: jpeg,png,jpg,gif,svg',
            'unique' => 'Tên nhãn hiệu đã tồn tại',
            
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{
            $tennhanhieu = $request->tennhanhieu;
            $hinhnhanhieu = $request->file('hinhnhanhieu');
            $date = Carbon::now();
            //$date = $date->format('dmYhis'); // ngày tháng năm giờ phút giây
            $date = $date->format('dmy');
            if($request->hasFile('hinhnhanhieu')){
                $nhanhieu = new nhan_hieu;
                $nhanhieu->fill([
                    'ten_nhan_hieu'=>$tennhanhieu,
                    'hinh_nhan_hieu'=>'',
                ]);
                $nhanhieu->save();
                $idnhanhieu = $nhanhieu->id;
                // đặt tên file và kiểu file
                // getClientoriginalName() : lấy tên file cũ
                // getClientOriginalExtension(): lấy đuôi file
                //$file_name = time().Str::random(10).'.'.$hinhnhanhieu->getClientOriginalExtension();
                $file_name = $date.$hinhnhanhieu->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
                $imagePath = $hinhnhanhieu->move(public_path('hinh_nhanhieu/'.$idnhanhieu), $file_name);
                $nhanhieu->hinh_nhan_hieu = 'hinh_nhanhieu/'.$idnhanhieu.'/'.$file_name;
                $nhanhieu->save();
            }
            return response()->json([
                'status'=>200,
                'mess'=>  'thêm thành công',
            ]);
        }

    }

    public function get_sua_nhan_hieu($id){
        $output = '';
        $nhanhieu  = nhan_hieu::find($id);
        return  view('admin.nhanhieu.nhanhieu-sua')->with(['nhanhieu'=>$nhanhieu]);
    }

    public function post_sua_nhan_hieu(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'tennhanhieu' => 'required',
        ], $messages = [
            'required' => 'Tên nhãn hiệu không được bỏ trống',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{
            $tennhanhieu = $request->tennhanhieu;
            $hinhnhanhieu = $request->file('hinhnhanhieu');
            $date = Carbon::now();
            //$date = $date->format('dmYhis'); // ngày tháng năm giờ phút giây
            $date = $date->format('dmy');
            $nhanhieu = nhan_hieu::find($id);
            $nhanhieu->ten_nhan_hieu = $tennhanhieu;
            if($request->hasFile('hinhnhanhieu')){
                $idnhanhieu = $nhanhieu->id;
                // đặt tên file và kiểu file
                // getClientoriginalName() : lấy tên file cũ
                // getClientOriginalExtension(): lấy đuôi file
                $file_name = $date.$hinhnhanhieu->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
                $imagePath = $hinhnhanhieu->move(public_path('hinh_nhanhieu/'.$idnhanhieu), $file_name);
                $nhanhieu->hinh_nhan_hieu = 'hinh_nhanhieu/'.$idnhanhieu.'/'.$file_name;
                
            }
            $nhanhieu->save();
            return response()->json([
                'status'=>200,
                'mess'=>  'sửa thành công',
            ]);
        }

    }

    public function xoa_nhan_hieu($id){
        $nhanhieu  = nhan_hieu::find($id);
        $nhanhieu->delete();
        return response()->json([
            'status'=>200,
            'mess'=> 'Xóa thành công',
        ]);

    }
}
