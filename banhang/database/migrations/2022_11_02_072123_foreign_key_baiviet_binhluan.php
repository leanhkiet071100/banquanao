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
        Schema::table('baiviet_binhluans', function ($table) {      
            $table->foreign('ma_bai_viet')->references('id')->on('baiviets');
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
         Schema::table('baiviet_binhluans', function (Blueprint $table) {
            $table->dropForeign('baiviet_binhluans_ma_bai_viet_foreign');
            $table->dropForeign('baiviet_binhluans_ma_nguoi_dung_foreign');
        });
    }
};
