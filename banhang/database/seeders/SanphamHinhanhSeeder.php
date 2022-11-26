<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SanphamHinhanhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sanpham_hinhanhs')->insert([
            [
                'ma_san_pham' => 1,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 1,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 1,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 2,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 3,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 4,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 5,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 6,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 7,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 8,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
            [
                'ma_san_pham' => 9,
                'hinh_san_pham' => 'hinh_test/test.jpg',
            ],
        ]);
    }
}
