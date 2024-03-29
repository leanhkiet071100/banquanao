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
        Schema::create('nguoidung_diachis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_nguoi_dung');
            $table->string('tinh')->nullable();
            $table->string('huyen')->nullable();
            $table->string('xa')->nullable();
            $table->string('dia_chi_cu_the')->nullable();
            $table->string('ho_ten')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->boolean('mac_dinh')->nullable();
            $table->string('trang_thai')->nullable();
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
        Schema::dropIfExists('nguoidung_diachis');
    }
};
