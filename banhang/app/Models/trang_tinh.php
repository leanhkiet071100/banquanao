<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\logo;
use Illuminate\Database\Eloquent\SoftDeletes;

class trang_tinh extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'tieu_de',
        'noi_dung',
        'loai',
        'hinh_anh',
        'trang_thai',
    ];
}
