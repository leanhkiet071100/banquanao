<?php

namespace App\Http\Controllers;

use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\sanpham;
use App\Models\sanpham_hinhanh;
use App\Http\Requests\Storesanpham_chitietRequest;
use App\Http\Requests\Updatesanpham_chitietRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SanphamChitietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chi_tiet_san_pham($id)
    {
        $sanpham =  sanpham::join('loai_san_phams','loai_san_phams.id', '=','sanphams.ma_loai_san_pham')
                    ->join('nhan_hieus','Nhan_hieus.id', '=','sanphams.ma_nhan_hieu')
                    ->select('nhan_hieus.ten_nhan_hieu','sanphams.*','loai_san_phams.ten_loai_san_pham')
                    ->find($id);
        $lsloaisanpham = loai_san_pham::where('hien','=',1)->get();
        $lshinhanh = sanpham_hinhanh::where('ma_san_pham',$id)->get();

        return view('sanpham.chitietsanpham')->with(['lsloaisanpham'=>$lsloaisanpham,'sanpham'=>$sanpham,'lshinhanh'=>$lshinhanh]);
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
     * @param  \App\Http\Requests\Storesanpham_chitietRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storesanpham_chitietRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanpham_chitiet  $sanpham_chitiet
     * @return \Illuminate\Http\Response
     */
    public function show(sanpham_chitiet $sanpham_chitiet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanpham_chitiet  $sanpham_chitiet
     * @return \Illuminate\Http\Response
     */
    public function edit(sanpham_chitiet $sanpham_chitiet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatesanpham_chitietRequest  $request
     * @param  \App\Models\sanpham_chitiet  $sanpham_chitiet
     * @return \Illuminate\Http\Response
     */
    public function update(Updatesanpham_chitietRequest $request, sanpham_chitiet $sanpham_chitiet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanpham_chitiet  $sanpham_chitiet
     * @return \Illuminate\Http\Response
     */
    public function destroy(sanpham_chitiet $sanpham_chitiet)
    {
        //
    }
}
