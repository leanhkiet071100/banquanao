<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\thong_tin_shop;
use Illuminate\Database\Eloquent\SoftDeletes;

class logo extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ma_shop',
        'hinh_logo',
        'hinh_banner',
        'hien_logo',
        'hien_banner',
    ];

    public function thong_tin_shop()
    {
        return $this->hasOne(thong_tin_shop::class,'ma_shop','id');
    }

}
