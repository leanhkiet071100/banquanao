<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\hoadon_chitiet;

class hoadon extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;
    protected $fillable = [
        'ma_nguoi_dung',
        'ma_giam_gia',
        'ten_hoa_don',
        'hien',
        'noi_bat',
        'moi',
    ];

    public function hoadon_chitiet(){
        return $this->belongsTo(hoadon::class, 'ma_hoa_don', 'id');
    }
}
