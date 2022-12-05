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
use App\Models\logo;

class AdminLogoController extends Controller
{
    // public function fixImagelogo(logo $logo){
    //     if(storage::disk('public')->exists($logo->hinh_logo))
    //     {
    //        //$user->avatar = asset('storage/'.$user->avatar);
    //         $logo->logo = Storage::url($logo->hinh_logo);
    //     }
    //     else
    //     {
    //         $logo->logos = 'storage/hinhnhanhieu/no-image.png';
    //     }
    // }
    public function logo(){
        $logo = logo::orderBy('id')->first();
        return view('admin.hinhanh.logo')->with(['logo'=>$logo]);
    }

    public function logo_them(Request $request){
        $rule = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $message =[
            'required' => 'Xin hãy thêm hình ảnh logo',
            'image' => 'Đây không phải là hình ảnh',
            'mimes' => 'hình ảnh phải có đuối là: jpeg,png,jpg,gif,svg'
        ];

        $request->validate($rule, $message);

        if($request->hasFile('image'))
        {
            $hinh_logo = $request->file('image');
            $date = Carbon::now();
            $date = $date->format('dmy');
            $logo = new logo;
            $file_name = $date.$hinh_logo->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $hinh_logo->move(public_path('hinh_logo/'), $file_name);
            $logo->hinh_logo = 'hinh_logo/'.$file_name;
            $logo->save();
            return Redirect::route('admin.logo')->with('success','thêm thành công');
        }
       

    }

    public function logo_sua(Request $request,$id){
        $rule = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $message =[
            'required' => 'Xin hãy thêm hình ảnh logo',
            'image' => 'Đây không phải là hình ảnh',
            'mimes' => 'hình ảnh phải có đuối là: jpeg,png,jpg,gif,svg'
        ];

        $request->validate($rule, $message);

        if($request->hasFile('image'))
        {
            $hinh_logo = $request->file('image');
            $date = Carbon::now();
            $date = $date->format('dmy');
            $logo = logo::find($id);
            $file_name = $date.$hinh_logo->getClientoriginalName();
                // move:  di chuyển hình ảnh; public_path: tạo  thư mục ; $file_name: tên file 
            $imagePath = $hinh_logo->move(public_path('hinh_logo/'), $file_name);
            $logo->hinh_logo = 'hinh_logo/'.$file_name;
            $logo->save();
            return Redirect::route('admin.logo')->with('success','Sửa thành công');
        }
    }
}
