<?php

namespace App\Exports;

use App\Models\sanpham;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

//class XuatSanPham implements FromCollection
class XuatSanPham implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return sanpham::all();
    // }

    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
        return view('exports.sanphams', [
            'sanphams' => sanpham::all()
        ]);
    }
}
