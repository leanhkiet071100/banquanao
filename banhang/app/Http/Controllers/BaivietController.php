<?php

namespace App\Http\Controllers;

use App\Models\baiviet;
use App\Http\Requests\StorebaivietRequest;
use App\Http\Requests\UpdatebaivietRequest;

class BaivietController extends Controller
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
