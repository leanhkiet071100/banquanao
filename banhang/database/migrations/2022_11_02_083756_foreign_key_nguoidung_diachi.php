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
        Schema::table('nguoidung_diachis', function ($table) {      
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
         Schema::table('nguoidung_diachis', function (Blueprint $table) {
            $table->dropForeign('nguoidung_diachis_ma_nguoi_dung_foreign');
        });
    }
};
