<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\sanpham;

class sanpham_chitiet extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ma_san_pham',
        'mau',
        'kich_thuoc',
        'so_luong_kho',
        'hien',
        'noi_bat',
        'moi',
        
    ];

    public function sanpham(){
        return $this->hasMany(sanpham::class, 'ma_san_pham', 'id');
    }
}
