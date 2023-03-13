<?php

namespace App\Http\Controllers;

use App\Models\trang_tinh;
use App\Http\Requests\Storetrang_tinhRequest;
use App\Http\Requests\Updatetrang_tinhRequest;

class TrangTinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storetrang_tinhRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetrang_tinhRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trang_tinh  $trang_tinh
     * @return \Illuminate\Http\Response
     */
    public function show(trang_tinh $trang_tinh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trang_tinh  $trang_tinh
     * @return \Illuminate\Http\Response
     */
    public function edit(trang_tinh $trang_tinh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetrang_tinhRequest  $request
     * @param  \App\Models\trang_tinh  $trang_tinh
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetrang_tinhRequest $request, trang_tinh $trang_tinh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trang_tinh  $trang_tinh
     * @return \Illuminate\Http\Response
     */
    public function destroy(trang_tinh $trang_tinh)
    {
        //
    }
}
