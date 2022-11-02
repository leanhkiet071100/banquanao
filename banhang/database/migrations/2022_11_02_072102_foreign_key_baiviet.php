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
         Schema::table('baiviets', function ($table) {      
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
        Schema::table('baiviets', function (Blueprint $table) {
            $table->dropForeign('baiviets_ma_nguoi_dung_foreign');
        });
    }
};
