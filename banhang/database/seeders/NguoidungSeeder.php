<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Str;
use DB;

class NguoidungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('nguoidungs')->insert([
            [
                
                'ten' => 'admin',
                'email' => 'admin@gmail.com',
                'mat_khau' => Hash::make('123456'),
                'hinh_dai_dien' => null,
                'cap' => 1,
                'mo_ta' => null,
                'trang_thai'=>1,
            ],
            [
                
                'ten' => 'CodeLean',
                'email' => 'CodeLean@gmail.com',
                'mat_khau' => Hash::make('123456'),
                'hinh_dai_dien' => null,
                'cap' => 2,
                'mo_ta' => null,
                'trang_thai'=>1,
            ],

            [
                
                'ten' => 'Shane Lynch',
                'email' => 'ShaneLynch@gmail.com',
                'mat_khau' => Hash::make('123456'),
                'hinh_dai_dien' => 'hinh_test/test.jpg',
                'cap' => 2,
                'mo_ta' => 'Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud amodo',
                'trang_thai'=>0,
            ],
            [
                
                'ten' => 'Brandon Kelley',
                'email' => 'BrandonKelley@gmail.com',
                'mat_khau' => Hash::make('123456'),
                'hinh_dai_dien' => 'hinh_test/test.jpg',
                'cap' => 2,
                'mo_ta' => null,
                'trang_thai'=>0,
            ],
            [
                
                'ten' => 'Roy Banks',
                'email' => 'RoyBanks@gmail.com',
                'mat_khau' => Hash::make('123456'),
                'hinh_dai_dien' => 'hinh_test/test.jpg',
                'cap' => 0,
                'mo_ta' => null,
                'trang_thai'=>2,
            ],
        ]);
    }
}
