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
        Schema::table('sanphams', function ($table) {      
            $table->foreign('ma_nhan_hieu')->references('id')->on('nhan_hieus');
            $table->foreign('ma_loai_san_pham')->references('id')->on('loai_san_phams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sanphams', function (Blueprint $table) {
            $table->dropForeign('sanphams_ma_nhan_hieu_foreign');
            $table->dropForeign('sanphams_ma_loai_san_pham_foreign');
        });
    }
};
