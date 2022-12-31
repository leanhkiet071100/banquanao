<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("slideshows")->insert([
            [
                'hinh_slideshow' => 'Hinh_test/slideshow_1.jpg',
                'link' => 'https://www.google.com/?hl=vi',
                'tieu_de' => null,
                'hien' => 1,
                //'noi_bat' => 1,
            ],
            [
                'hinh_slideshow' => 'Hinh_test/slideshow_2.jpg',
                'link' => '',
                'tieu_de' => 'goggle',
                'hien' => 1,
                //'noi_bat' => 0,
            ],
            [
                'hinh_slideshow' => 'Hinh_test/slideshow_3.jpg',
                'link' => '',
                'tieu_de' => 'goggle',
                'hien' => 0,
                //'noi_bat' => 0,
            ],

        ]);
    }
}
