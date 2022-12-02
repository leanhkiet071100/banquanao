<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\sanpham;

class loai_san_pham extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ten_loai_san_pham',
        'tag_loai_san_pham',
        'hien',
        'noi_bat',
        'moi',
    ];

    public function sanpham(){
        return $this->belongsTo(sanpham::class, 'ma_loai_san_pham', 'id');
    }
}
