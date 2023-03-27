<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sanpham_binhluan_hinhanhs', function ($table) {      
            $table->foreign('ma_binh_luan')->references('id')->on('sanpham_binhluans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sanpham_binhluan_hinhanhs', function (Blueprint $table) {
            $table->dropForeign('sanpham_binhluan_hinhanhs_ma_binh_luan');
        });
    }
};
