<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;


class LoaiSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("loai_san_phams")->insert([
            [
                'ten_loai_san_pham' => 'Men',
            ],
            [
                'ten_loai_san_pham' => 'Women',
            ],
            [
                'ten_loai_san_pham' => 'Kids',
            ],
        ]);
    }
}
