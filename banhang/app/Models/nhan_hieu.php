<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\sanpham;

class nhan_hieu extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ten_nhan_hieu',
        'hien',
    ];

    public function sanpham(){
        return $this->belongsTo(sanpham::class, 'ma_nhan_hieu', 'id');
    }


}
