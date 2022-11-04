<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\baiviet_binhluan;
use App\Models\nguoidung;

class baiviet extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ma_nguoi_dung',
        'tieu_de',
        'phu_de',
        'hinh_anh',
        'loai_bai_viet',
        'noi_dung',     
    ];
    
    public function baiviet_binhluan(){
        return $this->belongsTo(baiviet_binhluan::class, 'ma_bai_viet', 'id');
    }

    public function nguoidung(){
        return $this->belongsTo(baiviet_binhluan::class, 'ma_bai_viet', 'id');
    }
}
