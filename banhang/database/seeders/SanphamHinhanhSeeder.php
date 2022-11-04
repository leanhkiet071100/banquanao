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
                'luu' => 'product-1.jpg',
            ],
            [
                'ma_san_pham' => 1,
                'luu' => 'product-1-1.jpg',
            ],
            [
                'ma_san_pham' => 1,
                'luu' => 'product-1-2.jpg',
            ],
            [
                'ma_san_pham' => 2,
                'luu' => 'product-2.jpg',
            ],
            [
                'ma_san_pham' => 3,
                'luu' => 'product-3.jpg',
            ],
            [
                'ma_san_pham' => 4,
                'luu' => 'product-4.jpg',
            ],
            [
                'ma_san_pham' => 5,
                'luu' => 'product-5.jpg',
            ],
            [
                'ma_san_pham' => 6,
                'luu' => 'product-6.jpg',
            ],
            [
                'ma_san_pham' => 7,
                'luu' => 'product-7.jpg',
            ],
            [
                'ma_san_pham' => 8,
                'luu' => 'product-8.jpg',
            ],
            [
                'ma_san_pham' => 9,
                'luu' => 'product-9.jpg',
            ],
        ]);
    }
}
