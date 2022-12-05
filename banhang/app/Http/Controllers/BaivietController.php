<?php

namespace App\Http\Controllers;

use App\Models\baiviet;
use App\Models\sanpham;
use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Http\Requests\StorebaivietRequest;
use App\Http\Requests\UpdatebaivietRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//chia sẻ dữ liệu nhiều view

class BaivietController extends Controller
{
    public $lsloaisanpham ;
    public $loaibaiviet;
    public $lsbaivietmoi;

    public function menu_bai_viet()
    {
        $lsloaisanpham = loai_san_pham::where('hien','=',1)->get();
        $loaibaiviet = baiviet::select('loai_bai_viet')->distinct('loai_bai_viet')->get();
        $lsbaivietmoi = baiviet::where('hien','=',1)->where('moi','=',1)->orderBy('created_at', 'DESC')->paginate(3);
        return view('baiviet.menubaiviet')->with(['lsloaisanpham'=>$lsloaisanpham,'loaibaiviet'=>$loaibaiviet,'lsbaivietmoi'=>$lsbaivietmoi]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lsbaiviet = baiviet::where('hien','=',1)->paginate(6);
        $lsbaivietnb = baiviet::where('hien','=',1)->where('noi_bat','=',1)->orderBy('created_at', 'DESC')->limit(3)->get();
        return view('baiviet.dsbaiviet')->with(['lsbaiviet'=>$lsbaiviet,'lsbaivietnb'=>$lsbaivietnb]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chi_tiet_bai_viet($id)
    {
        $baiviet = baiviet::join('nguoidungs','nguoidungs.id','=','baiviets.ma_nguoi_dung')->select('baiviets.*','nguoidungs.ten','nguoidungs.hinh_dai_dien')->find($id);
        return view('baiviet.chitietbaiviet')->with(['baiviet'=>$baiviet]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebaivietRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebaivietRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\baiviet  $baiviet
     * @return \Illuminate\Http\Response
     */
    public function show(baiviet $baiviet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\baiviet  $baiviet
     * @return \Illuminate\Http\Response
     */
    public function edit(baiviet $baiviet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebaivietRequest  $request
     * @param  \App\Models\baiviet  $baiviet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebaivietRequest $request, baiviet $baiviet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\baiviet  $baiviet
     * @return \Illuminate\Http\Response
     */
    public function destroy(baiviet $baiviet)
    {
        //
    }
}
