<?php

namespace App\Http\Controllers;

use App\Models\nhan_hieu;
use App\Http\Requests\Storenhan_hieuRequest;
use App\Http\Requests\Updatenhan_hieuRequest;

class NhanHieuController extends Controller
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
     * @param  \App\Http\Requests\Storenhan_hieuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storenhan_hieuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nhan_hieu  $nhan_hieu
     * @return \Illuminate\Http\Response
     */
    public function show(nhan_hieu $nhan_hieu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nhan_hieu  $nhan_hieu
     * @return \Illuminate\Http\Response
     */
    public function edit(nhan_hieu $nhan_hieu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatenhan_hieuRequest  $request
     * @param  \App\Models\nhan_hieu  $nhan_hieu
     * @return \Illuminate\Http\Response
     */
    public function update(Updatenhan_hieuRequest $request, nhan_hieu $nhan_hieu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nhan_hieu  $nhan_hieu
     * @return \Illuminate\Http\Response
     */
    public function destroy(nhan_hieu $nhan_hieu)
    {
        //
    }
}
