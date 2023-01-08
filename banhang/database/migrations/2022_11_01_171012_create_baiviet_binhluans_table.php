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
        Schema::create('baiviet_binhluans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_bai_viet');
            $table->foreignId('ma_nguoi_dung');
            $table->foreignId('id_binh_luan_cha')->nullable();
            $table->text('noi_dung')->nullable();
            $table->boolean('hien')->nullable();
            $table->boolean('noi_bat')->nullable();
            $table->text('trang_thai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baiviet_binhluans');
    }
};
