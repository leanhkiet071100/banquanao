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
        Schema::create('trang_tinhs', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de')->nullable();
            $table->text('noi_dung')->nullable();
            $table->string('loai')->nullable();
            $table->text('hinh_anh')->nullable();
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
        Schema::dropIfExists('trang_tinhs');
    }
};
