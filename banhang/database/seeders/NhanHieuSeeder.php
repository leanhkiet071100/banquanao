<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class NhanHieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhan_hieus')->insert([
            [
                'ten_nhan_hieu' => 'Calvin Klein',
                'hinh_nhan_hieu'=>'hinh_test/test.jpg'
            ],
            [
                'ten_nhan_hieu' => 'Diesel',
                'hinh_nhan_hieu'=>'hinh_test/test.jpg'
            ],
            [
                'ten_nhan_hieu' => 'Polo',
                'hinh_nhan_hieu'=>'hinh_test/test.jpg'
            ],
            [
                'ten_nhan_hieu' => 'Tommy Hilfiger',
                'hinh_nhan_hieu'=>'hinh_test/test.jpg'
            ],
        ]);
    }
}
