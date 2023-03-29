<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\baiviet;
use App\Models\thong_tin_shop;
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
use Illuminate\Http\Request;

class SanphamController extends Controller
{
    public function san_pham(){
      
        $lsmau = sanpham_chitiet::select('mau')->distinct('mau')->get();
        $lssize = sanpham_chitiet::select('kich_thuoc')->distinct('kich_thuoc')->get();
        $lssanphamsale = sanpham::where('tien_giam','>',0)->orderBy('tien_giam','DESC')->paginate(8);
        $lssanpham = sanpham::where('hien','=',1)->paginate(12);
        $shop = thong_tin_shop::orderBy('id')->first();
        return view('sanpham.dssanpham')->with(['lsmau'=>$lsmau,'lssize'=>$lssize,'lssanphamsale'=>$lssanphamsale,'lssanpham'=>$lssanpham]);
    }
   
}
