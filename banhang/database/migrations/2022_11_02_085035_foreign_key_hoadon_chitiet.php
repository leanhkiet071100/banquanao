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
        Schema::table('hoadon_chitiets', function ($table) {      
            $table->foreign('ma_san_pham')->references('id')->on('sanphams');
            $table->foreign('ma_hoa_don')->references('id')->on('hoadons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hoadon_chitiets', function (Blueprint $table) {
            $table->dropForeign('hoadon_chitiets_ma_sam_pham_foreign');
            $table->dropForeign('hoadon_chitiets_ma_hoa_don_foreign');
        });
    }
};
