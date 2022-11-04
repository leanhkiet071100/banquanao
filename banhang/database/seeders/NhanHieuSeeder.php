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
            ],
            [
                'ten_nhan_hieu' => 'Diesel',
            ],
            [
                'ten_nhan_hieu' => 'Polo',
            ],
            [
                'ten_nhan_hieu' => 'Tommy Hilfiger',
            ],
        ]);
    }
}
