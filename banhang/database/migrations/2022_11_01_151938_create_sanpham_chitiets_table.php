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
        Schema::create('sanpham_chitiets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_san_pham');
            $table->string('mau');
            $table->string('kich_thuoc'); // size
            $table->integer('so_luong_kho');
            $table->boolean('moi')->nullable();
            $table->boolean('noi_bat')->nullable();
            $table->boolean('hien')->nullable();
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
        Schema::dropIfExists('sanpham_chitiets');
    }
};
