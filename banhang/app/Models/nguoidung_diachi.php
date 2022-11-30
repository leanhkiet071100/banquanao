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
        'dia_chi_noi_chon',
        'noi',
        'hien',
        'noi_bat',
        'moi',
    ];

    public function nguoidung(){
        return $this->hasMany(nguoidung::class, 'ma_nguoi_dung', 'id');
    }
}
