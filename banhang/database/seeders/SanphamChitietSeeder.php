<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SanphamChitietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sanpham_chitiets')->insert([
            [
                'ma_san_pham' => 1,
                'mau' => 'blue',
                'kich_thuoc' => 'S',
                'so_luong_kho' => 5,
                'hien'=>1,
                // 'noi_bat'=> 0,
                // 'moi'=>0,
            ],
            [
                'ma_san_pham' => 1,
                'mau' => 'blue',
                'kich_thuoc' => 'M',
                'so_luong_kho' => 5,
                'hien'=>1,
                // 'noi_bat'=> 0,
                // 'moi'=>0,
            ],
            [
                'ma_san_pham' => 1,
                'mau' => 'blue',
                'kich_thuoc' => 'L',
                'so_luong_kho' => 5,
                'hien'=>1,
                // 'noi_bat'=> 0,
                // 'moi'=>0,
            ],
            [
                'ma_san_pham' => 1,
                'mau' => 'blue',
                'kich_thuoc' => 'XS',
                'so_luong_kho' => 5,
                'hien'=>1,
                // 'noi_bat'=> 0,
                // 'moi'=>0,
            ],
            [
                'ma_san_pham' => 1,
                'mau' => 'yellow',
                'kich_thuoc' => 'S',
                'so_luong_kho' => 0,
                'hien'=>1,
                // 'noi_bat'=> 0,
                // 'moi'=>0,
            ],
            [
                'ma_san_pham' => 1,
                'mau' => 'violet',
                'kich_thuoc' => 'S',
                'so_luong_kho' => 0,
                'hien'=>1,
                // 'noi_bat'=> 0,
                // 'moi'=>0,
            ],
        ]);

    }
}
