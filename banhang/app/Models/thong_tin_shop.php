<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\logo;


class thong_tin_shop extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ten_shop',
        'so_dien_thoai',
        'zalo',
        'eamil',
        'dia_chi',
        'ban_do',
        'thoi_gian_mo',
        'thoi_gian_dong',
    ];

    protected $primayKey = 'id';
    protected $table = 'shops';

        public function logo()
    {
        return $this->hasOne(logo::class,'ma_shop','id');
    }
}
