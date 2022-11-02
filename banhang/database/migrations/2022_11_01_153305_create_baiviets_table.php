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
        Schema::create('baiviets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_nguoi_dung')->nullable();
            $table->string('tieu_de');
            $table->string('phu_de')->nullable();
            $table->string('hinh_anh');
            $table->string('loai_bai_viet')->nullable();
            $table->text('noi_dung');
            $table->boolean('moi')->nullable();
            $table->boolean('noi_bat')->nullable();
            $table->boolean('hien')->nullable();
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
        Schema::dropIfExists('baiviets');
    }
};
