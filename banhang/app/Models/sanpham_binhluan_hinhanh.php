<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sanpham_binhluan_hinhanh extends Model
{
    
 use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ten_file',
        'ma_binh_luan',
        'hien',
        'trang_thai',
    ];

    public function sanpham_binhluan(){
        return $this->hasMany(sanpham_binhluan::class, 'ma_san_pham', 'id');
    }
}
