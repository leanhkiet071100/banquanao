<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hinh_anh extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'hinh_anh',
        'link',
        'tieu_de',
        'hien',
        'noi_bat',
    ];
}
