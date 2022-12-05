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
        Schema::table('gio_hangs', function ($table) {      
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
        Schema::table('gio_hangs', function (Blueprint $table) {
            $table->dropForeign('gio_hangs_ma_san_pham_foreign');
            $table->dropForeign('gio_hangs_ma_nguoi_dung_pham_foreign');
        });
    }
};
