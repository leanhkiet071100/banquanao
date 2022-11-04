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
        Schema::create('nguoidungs', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mat_khau');
            $table->rememberToken(); // token người dùng
            $table->string('hinh_dai_dien')->nullable();
            $table->tinyInteger('cap'); // 0: host, 1: admin, 2: người dùng
            $table->text('mo_ta')->nullable();
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
        Schema::dropIfExists('nguoidungs');
    }
};
