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
        Schema::create('sanphams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_nhan_hieu');
            $table->foreignId('ma_loai_san_pham');
            $table->string('ten_san_pham');
            $table->text('mo_ta')->nullable();
            $table->text('noi_dung')->nullable();
            $table->double('gia'); 
            $table->integer('so_luong_kho'); // số lượng tồn kho
            $table->double('tien_giam')->nullable();
            $table->double('trong_luong')->nullable();
            $table->string('tag')->nullable();
            $table->string('SKU')->nullable(); // SKU chính là 1 dạng mã số quy ước giúp phân loại mẫu sản phẩm, dịch vụ 
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
        Schema::dropIfExists('sanphams');
    }
};
