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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('ten_shop');
            $table->string('so_dien_thoai')->nullable();;
            $table->string('zalo')->nullable();
            $table->string('email')->nullable();
            $table->text('dia_chi')->nullable();
            $table->text('ban_do')->nullable();
            $table->time('thoi_gian_mo')->nullable();
            $table->time('thoi_gian_dong')->nullable();
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
        Schema::dropIfExists('thong_tin_shops');
    }
};
