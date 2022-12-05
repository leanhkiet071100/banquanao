<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\logo;use Illuminate\Database\Eloquent\SoftDeletes;


class thong_tin_shop extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ten_shop',
        'so_dien_thoai',
        'zalo',
        'email',
        'dia_chi',
        'ban_do',
        'thoi_gian_mo',
        'thoi_gian_dong',
        'noi_dung',
    ];

    protected $primayKey = 'id';
    protected $table = 'shops';

        public function logo()
    {
        return $this->hasOne(logo::class,'ma_shop','id');
    }
}
