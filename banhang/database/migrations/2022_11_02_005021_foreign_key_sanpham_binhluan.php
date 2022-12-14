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
        Schema::table('sanpham_binhluans', function ($table) {      
            $table->foreign('ma_san_pham')->references('id')->on('sanphams');
            $table->foreign('ma_nguoi_dung')->references('id')->on('nguoidungs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sanpham_binhluans', function (Blueprint $table) {
            $table->dropForeign('sanpham_binhluans_ma_san_pham_foreign');
            $table->dropForeign('sanpham_binhluans_ma_nguoi_dung_foreign');
        });
    }
};
