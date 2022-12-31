<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SanphamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sanphams')->insert([
            [
                'id' => 1,
                'ma_nhan_hieu' => 1,
                'ma_loai_san_pham' => 2,
                'ten_san_pham' => 'Pure Pineapple',
                'mo_ta' => 'Lorem ipsum dolor sit amet, consectetur ing elit, sed do eiusmod tempor sum dolor sit amet, consectetur adipisicing elit, sed do mod tempor',
                'noi_dung' => '',
                'gia' => 629.99,
                'so_luong_kho' => 20,
                'tien_giam' => 495,
                'trong_luong' => 1.3,
                'sku' => '00012',
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => true,
                'tag' => 'Clothing',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 1,
            ],
            [
                'id' => 2,
                'ma_nhan_hieu' => 2,
                'ma_loai_san_pham' => 2,
                'ten_san_pham' => 'Guangzhou sweater',
                'mo_ta' => null,
                'noi_dung' => null,
                'gia' => 35,
                'so_luong_kho' => 20,
                'tien_giam' => 13,
                'trong_luong' => null,
                'sku' => null,
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => true,
                'tag' => 'Clothing',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 1,
            ],
            [
                'id' => 3,
                'ma_nhan_hieu' => 1,
                'ma_loai_san_pham' => 2,
                'ten_san_pham' => 'Guangzhou sweater',
                'mo_ta' => null,
                'noi_dung' => null,
                'gia' => 35,
                'so_luong_kho' => 20,
                'tien_giam' => 34,
                'trong_luong' => null,
                'sku' => null,
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => true,
                'tag' => 'Clothing',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 1,
            ],
            [
                'id' => 4,
                'ma_nhan_hieu' => 1,
                'ma_loai_san_pham' => 1,
                'ten_san_pham' => 'Microfiber Wool Scarf',
                'mo_ta' => null,
                'noi_dung' => null,
                'gia' => 64,
                'so_luong_kho' => 20,
                'tien_giam' => 35,
                'trong_luong' => null,
                'sku' => null,
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => true,
                'tag' => 'Accessories',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 0,
            ],
            [
                'id' => 5,
                'ma_nhan_hieu' => 1,
                'ma_loai_san_pham' => 3,
                'ten_san_pham' => "Men's Painted Hat",
                'mo_ta' => null,
                'noi_dung' => null,
                'gia' => 44,
                'so_luong_kho' => 20,
                'tien_giam' => 35,
                'trong_luong' => null,
                'sku' => null,
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => false,
                'tag' => 'Accessories',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 0,
            ],
            [
                'id' => 6,
                'ma_nhan_hieu' => 1,
                'ma_loai_san_pham' => 2,
                'ten_san_pham' => 'Converse Shoes',
                'mo_ta' => null,
                'noi_dung' => null,
                'gia' => 35,
                'so_luong_kho' => 20,
                'tien_giam' => 34,
                'trong_luong' => null,
                'sku' => null,
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => true,
                'tag' => 'Clothing',
                'hien' => 1,
                'moi' => 0,
                'noi_bat' => 0,
            ],
            [
                'id' => 7,
                'ma_nhan_hieu' => 1,
                'ma_loai_san_pham' => 1,
                'ten_san_pham' => 'Pure Pineapple',
                'mo_ta' => null,
                'noi_dung' => null,
                'gia' => 64,
                'so_luong_kho' => 20,
                'tien_giam' => 35,
                'trong_luong' => null,
                'sku' => null,
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => true,
                'tag' => 'HandBag',
                'hien' => 1,
                'moi' => 0,
                'noi_bat' => 0,
            ],
            [
                'id' => 8,
                'ma_nhan_hieu' => 1,
                'ma_loai_san_pham' => 1,
                'ten_san_pham' => '2 Layer Windbreaker',
                'mo_ta' => null,
                'noi_dung' => null,
                'gia' => 44,
                'so_luong_kho' => 20,
                'tien_giam' => 35,
                'trong_luong' => null,
                'sku' => null,
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => true,
                'tag' => 'Clothing',
                'hien' => 0,
                'moi' => 0,
                'noi_bat' => 0,
            ],
            [
                'id' => 9,
                'ma_nhan_hieu' => 1,
                'ma_loai_san_pham' => 1,
                'ten_san_pham' => 'Converse Shoes',
                'mo_ta' => null,
                'noi_dung' => null,
                'gia' => 35,
                'so_luong_kho' => 20,
                'tien_giam' => 34,
                'trong_luong' => null,
                'sku' => null,
                'hinh_anh' => 'hinh_test/test_sp.jpg',
                //'featured' => true,
                'tag' => 'Shoes',
                'hien' => 0,
                'moi' => 0,
                'noi_bat' => 0,
            ],
        ]);
    }
}
