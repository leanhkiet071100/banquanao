<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\nguoidung;


class nguoidung_diachi extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

     protected $fillable = [
        'ma_nguoi_dung',
        'tinh',
        'huyen',
        'xa',
        'dia_chi_cu_the',
        'ho_ten',
        'so_dien_thoai',
        'mac_dinh',
        'trang_thai',
    ];

    public function nguoidung(){
        return $this->hasMany(nguoidung::class, 'ma_nguoi_dung', 'id');
    }
}
