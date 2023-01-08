<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\nguoidung;
use App\Models\baiviet;

class baiviet_binhluan extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ma_bai_viet',
        'ma_nguoi_dung',
        'noi_dung',
        'id_binh_luan_cha',
        'hien',
        'noi_bat',
        'trang_thai',
    ];

    public function baiviet(){
        return $this->hasMany(baiviet::class, 'ma_bai_viet', 'id');
    }

    public function nguoidung(){
        return $this->hasMany(nguoidung::class, 'ma_nguoi_dung', 'id');
    }
}
