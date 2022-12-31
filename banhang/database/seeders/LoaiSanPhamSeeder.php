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
                'ten_loai_san_pham' => 'Quần',
                'tag_loai_san_pham' => 'quan',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 1,
            ],
            [
                'ten_loai_san_pham' => 'Áo',
                 'tag_loai_san_pham' => 'ao',
                 'hien' => 1,
                'moi' => 1,
                'noi_bat' => 1,
            ],
            [
                'ten_loai_san_pham' => 'Nam',
                'tag_loai_san_pham' => 'nam',
                'hien' => 1,
                'moi' => 0,
                'noi_bat' => 0, 
            ],
            [
                'ten_loai_san_pham' => 'Nữ',
                'tag_loai_san_pham' => 'nu',
                'hien' => 1,
                'moi' => 0,
                'noi_bat' => 0, 
            ],
        ]);
    }
}
