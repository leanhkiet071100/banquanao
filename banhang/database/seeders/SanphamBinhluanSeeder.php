<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SanphamBinhluanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sanpham_binhluans')->insert([
            [
                'ma_san_pham' => 1,
                'ma_nguoi_dung' => 1,
                //'ten' => 'Brandon Kelley',
                'noi_dung' => 'Nice !',
                'danh_gia' => 4,
                'hien' => 1,
                //'noi_bat' => 0,
                'trang_thai'=>1,
            ],
            [
                'ma_san_pham' => 1,
                'ma_nguoi_dung' => 2,
                //'email' => 'RoyBanks@gmail.com',
                //'name' => 'Roy Banks',
                'noi_dung' => 'Nice !',
                'danh_gia' => 4,
                'hien' => 1,
                //'noi_bat' => 0,
                'trang_thai'=>1,
            ],
        ]);
    }
}
