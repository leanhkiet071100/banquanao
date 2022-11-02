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
        Schema::create('hoadon_chitiets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_hoa_don');
            $table->foreignId('ma_san_pham');
            $table->double('so_luong');
            $table->double('tong_tien');
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
        Schema::dropIfExists('hoadon_chitiets');
    }
};
