<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ThongTinShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("shops")->insert([
            [
                'ten_shop' => 'Đan Trinh',
                'so_dien_thoai' => '123456789',
                'zalo' => '123456789',
                'email' => 'kiet@gmail.com',
                'dia_chi' => 'Thành phố Hồ Chi Minh',
                'ban_do'=> '',
                'thoi_gian_mo' => '13:00',
                'thoi_gian_dong' => '14:00',
                'noi_dung'=>null,
                'hinh_logo'=>'hinh_test/logo.png',
                'hinh_banner'=>'hinh_test/banner.jpg',
            ],
          

        ]);
    }
}
