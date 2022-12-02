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
                'tag_loai_san_pham' => '.men',
            ],
            [
                'ten_loai_san_pham' => 'Women',
                 'tag_loai_san_pham' => '.women',
            ],
            [
                'ten_loai_san_pham' => 'Kids',
                 'tag_loai_san_pham' => '.kids',
            ],
        ]);
    }
}
