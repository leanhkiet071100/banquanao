<?php

namespace App\Http\Controllers;

use App\Models\slideshow;
use App\Http\Requests\StoreslideshowRequest;
use App\Http\Requests\UpdateslideshowRequest;

class SlideshowController extends Controller
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
     * @param  \App\Http\Requests\StoreslideshowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreslideshowRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function show(slideshow $slideshow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function edit(slideshow $slideshow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateslideshowRequest  $request
     * @param  \App\Models\slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateslideshowRequest $request, slideshow $slideshow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function destroy(slideshow $slideshow)
    {
        //
    }
}
