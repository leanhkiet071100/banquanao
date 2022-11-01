<?php

namespace App\Http\Controllers;

use App\Models\loai_san_pham;
use App\Http\Requests\Storeloai_san_phamRequest;
use App\Http\Requests\Updateloai_san_phamRequest;

class LoaiSanPhamController extends Controller
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
     * @param  \App\Http\Requests\Storeloai_san_phamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeloai_san_phamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\loai_san_pham  $loai_san_pham
     * @return \Illuminate\Http\Response
     */
    public function show(loai_san_pham $loai_san_pham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\loai_san_pham  $loai_san_pham
     * @return \Illuminate\Http\Response
     */
    public function edit(loai_san_pham $loai_san_pham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateloai_san_phamRequest  $request
     * @param  \App\Models\loai_san_pham  $loai_san_pham
     * @return \Illuminate\Http\Response
     */
    public function update(Updateloai_san_phamRequest $request, loai_san_pham $loai_san_pham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\loai_san_pham  $loai_san_pham
     * @return \Illuminate\Http\Response
     */
    public function destroy(loai_san_pham $loai_san_pham)
    {
        //
    }
}
