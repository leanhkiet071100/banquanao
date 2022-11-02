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
        Schema::table('sanpham_chitiets', function ($table) {      
            $table->foreign('ma_san_pham')->references('id')->on('sanphams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sanpham_chitiets', function (Blueprint $table) {
            $table->dropForeign('sanpham_chitiets_ma_san_pham_foreign');
           
        });
    }
};
