<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\nguoidung_diachi;
use App\Models\baiviet;
use App\Models\baiviet_binhluan;
use App\Models\gio_hang;

class nguoidung extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ten',
        'email',
        'email_verified_at',
        'mat_khau',
        'remember_token',
        'hinh_dai_dien',
        'cap',
        'mo_ta',
        'hien',
        'noi_bat',
        'moi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function baiviet_binhluan(){
        return $this->hasMany(baiviet_binhluan::class, 'ma_nguoi_dung', 'id');
    }

    public function baiviet(){
        return $this->hasMany(baiviet::class, 'ma_nguoi_dung', 'id');
    }

    public function nguoidung_diachi(){
        return $this->belongsTo(nguoidung_diachi::class, 'ma_nguoi_dung', 'id');
    }

    public function nguoidung(){
        return $this->hasOne(gio_hang::class, 'ma_nguoi_dung', 'id');
    }
}
