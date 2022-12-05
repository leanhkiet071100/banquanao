<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sanpham;
use App\Models\nguoidung;

class gio_hang extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ma_san_pham',
        'ma_nguoi_dung',
        'so_luong',
    ];

    public function nguoidung(){
        return $this->hasOne(nguoidung::class, 'ma_nguoi_dung', 'id');
    }

    public function sanpham(){
        return $this->hasMany(sanpham::class, 'ma_san_pham', 'id');
    }

    

}
