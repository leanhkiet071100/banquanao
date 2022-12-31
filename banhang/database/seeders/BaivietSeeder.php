<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BaivietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('baiviets')->insert([
            [
                'ma_nguoi_dung' => 1,
                'tieu_de' => 'The Personality Trait That Makes People Happier',
                'hinh_anh' => 'hinh_test/blog.jpg',
                'loai_bai_viet' => 'TRAVEL',
                'noi_dung' => '',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 1,
            ],
            [
                'ma_nguoi_dung' => 3,
                'tieu_de' => 'This was one of our first days in Hawaii last week.',
                'hinh_anh' => 'hinh_test/blog.jpg',
                'loai_bai_viet' => 'CodeLeanON',
                'noi_dung' => '',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 1,
            ],
            [
                'ma_nguoi_dung' => 3,
                'tieu_de' => 'Last week I had my first work trip of the year to Sonoma Valley',
                'hinh_anh' => 'hinh_test/blog.jpg',
                'loai_bai_viet' => 'CodeLeanON',
                'noi_dung' => '',
                'hien' => 1,
                'moi' => 0,
                'noi_bat' => 0,
            ],
            [
                'ma_nguoi_dung' => 3,
                'tieu_de' => 'Happppppy New Year! I know I am a little late on this post',
                'hinh_anh' => 'hinh_test/blog.jpg',
                'loai_bai_viet' => 'CodeLeanON',
                'noi_dung' => '',
                'hien' => 1,
                'moi' => 1,
                'noi_bat' => 0,
            ],
            [
                'ma_nguoi_dung' => 3,
                'tieu_de' => 'Absolue collection. The Lancome team has been one…',
                'hinh_anh' => 'hinh_test/blog.jpg',
                'loai_bai_viet' => 'CodeLeanON',
                'noi_dung' => '',
                'hien' => 0,
                'moi' => 0,
                'noi_bat' => 0,
            ],
        ]);
    }
}
