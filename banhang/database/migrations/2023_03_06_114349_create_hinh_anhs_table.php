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
        Schema::create('hinh_anhs', function (Blueprint $table) {
            $table->id();
            $table->text('hinh_anhs')->nullable();;
            $table->text('link')->nullable();
            $table->string('tieu_de')->nullable();
            $table->string('loai')->nullable(); //1: slideshow 2: mạng xã hội 
            $table->boolean('hien')->nullable();
            $table->boolean('noi_bat')->nullable();
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
        Schema::dropIfExists('hinh_anhs');
    }
};
