<?php

namespace App\Http\Controllers;

use App\Models\baiviet_chitiet;
use App\Http\Requests\Storebaiviet_chitietRequest;
use App\Http\Requests\Updatebaiviet_chitietRequest;

class BaivietChitietController extends Controller
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
     * @param  \App\Http\Requests\Storebaiviet_chitietRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storebaiviet_chitietRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\baiviet_chitiet  $baiviet_chitiet
     * @return \Illuminate\Http\Response
     */
    public function show(baiviet_chitiet $baiviet_chitiet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\baiviet_chitiet  $baiviet_chitiet
     * @return \Illuminate\Http\Response
     */
    public function edit(baiviet_chitiet $baiviet_chitiet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebaiviet_chitietRequest  $request
     * @param  \App\Models\baiviet_chitiet  $baiviet_chitiet
     * @return \Illuminate\Http\Response
     */
    public function update(Updatebaiviet_chitietRequest $request, baiviet_chitiet $baiviet_chitiet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\baiviet_chitiet  $baiviet_chitiet
     * @return \Illuminate\Http\Response
     */
    public function destroy(baiviet_chitiet $baiviet_chitiet)
    {
        //
    }
}
