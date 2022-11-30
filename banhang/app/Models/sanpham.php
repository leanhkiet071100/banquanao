<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\sanpham_hinhanh;
use App\Models\sanpham_chitiet;
use App\Models\sanpham_binhluan;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\hoadon_chitiet;

class sanpham extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ma_nhan_hieu',
        'ma_loai_san_pham',
        'ten_san_pham',
        'mo_ta',
        'noi_dung',   
        'gia',
        'so_luong_kho',
        'tien_giam',
        'trong_luong',
        'tag',
        'SKU', 
        'hinh_anh',
        'hien',
        'noi_bat',
        'moi',
    ];

    protected $primayKey = 'id';
    protected $table = 'sanphams';

    //khóa ngoại hình ảnh sản phẩm 1
    public function sanpham_hinhanh(){
        return $this->belongsTo(sanpham_hinhanh::class, 'ma_san_pham', 'id');
    }

    //khóa ngoại chi tiết sản phẩm 2
    public function sanpham_chitiet(){
        return $this->belongsTo(sanpham_chitiet::class, 'ma_san_pham', 'id');
    }

    //khóa ngoại bình luận sản phẩm 3
    public function sanpham_binhluan(){
        return $this->belongsTo(sanpham_binhluan::class, 'ma_san_pham', 'id');
    }

    //khóa ngoại hóa đơn chi tiết 4
    public function hoadon_chitiet(){
        return $this->belongsTo(hoadon_chitiet::class, 'ma_san_pham', 'id');
    }

    //khóa ngoại nhãn hiệu 5
    public function nhan_hieu(){
        return $this->hasMany(nhan_hieu::class, 'ma_nhan_hieu', 'id');
    }

    //khóa ngoại loại sản phẩm 6
    public function loai_san_pham(){
        return $this->hasMany(loai_san_pham::class, 'ma_loai_san_pham', 'id');
    }
}
