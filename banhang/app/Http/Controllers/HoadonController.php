<?php

namespace App\Http\Controllers;

use App\Models\hoadon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class HoadonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function xuat_hoa_don()
    {
        return view('hoadon.xuathoadon');
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
     * @param  \App\Http\Requests\StorehoadonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorehoadonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hoadon  $hoadon
     * @return \Illuminate\Http\Response
     */
    public function show(hoadon $hoadon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hoadon  $hoadon
     * @return \Illuminate\Http\Response
     */
    public function edit(hoadon $hoadon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatehoadonRequest  $request
     * @param  \App\Models\hoadon  $hoadon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatehoadonRequest $request, hoadon $hoadon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hoadon  $hoadon
     * @return \Illuminate\Http\Response
     */
    public function destroy(hoadon $hoadon)
    {
        //
    }
}
