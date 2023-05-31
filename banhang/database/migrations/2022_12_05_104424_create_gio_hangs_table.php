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
        Schema::create('gio_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_san_pham');
            $table->foreignId('ma_nguoi_dung');
            $table->integer('so_luong');
            $table->string('size');
            $table->string('mau');
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
        Schema::dropIfExists('gio_hangs');
    }
};
