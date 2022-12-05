<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\baiviet;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function san_pham(){
      
        $lsmau = sanpham_chitiet::select('mau')->distinct('mau')->get();
        $lssize = sanpham_chitiet::select('kich_thuoc')->distinct('kich_thuoc')->get();
        $lssanphamsale = sanpham::where('tien_giam','>',0)->orderBy('tien_giam','DESC')->paginate(8);
        $lssanpham = sanpham::where('hien','=',1)->paginate(12);
        return view('sanpham.dssanpham')->with(['lsmau'=>$lsmau,'lssize'=>$lssize,'lssanphamsale'=>$lssanphamsale,'lssanpham'=>$lssanpham]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoresanphamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresanphamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show(sanpham $sanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(sanpham $sanpham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesanphamRequest  $request
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesanphamRequest $request, sanpham $sanpham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(sanpham $sanpham)
    {
        //
    }
}
