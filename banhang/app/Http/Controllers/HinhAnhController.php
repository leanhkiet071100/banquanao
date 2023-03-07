<?php

namespace App\Http\Controllers;

use App\Models\hinh_anh;
use App\Http\Requests\Storehinh_anhRequest;
use App\Http\Requests\Updatehinh_anhRequest;

class HinhAnhController extends Controller
{
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
     * @param  \App\Http\Requests\Storehinh_anhRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storehinh_anhRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hinh_anh  $hinh_anh
     * @return \Illuminate\Http\Response
     */
    public function show(hinh_anh $hinh_anh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hinh_anh  $hinh_anh
     * @return \Illuminate\Http\Response
     */
    public function edit(hinh_anh $hinh_anh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatehinh_anhRequest  $request
     * @param  \App\Models\hinh_anh  $hinh_anh
     * @return \Illuminate\Http\Response
     */
    public function update(Updatehinh_anhRequest $request, hinh_anh $hinh_anh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hinh_anh  $hinh_anh
     * @return \Illuminate\Http\Response
     */
    public function destroy(hinh_anh $hinh_anh)
    {
        //
    }
}
