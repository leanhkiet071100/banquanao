<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\sanpham;
use App\Models\hoadon;

class hoadon_chitiet extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ma_hoa_don',
        'ma_san_pham',
        'so_luong',
        'tong_tien',
        'trang_thai',
        
    ];

    public function sanpham(){
        return $this->hasMany(sanpham::class, 'ma_san_pham', 'id');
    }

    public function hoadon(){
        return $this->hasMany(hoadon::class, 'ma_hoa_don', 'id');
    }
}
