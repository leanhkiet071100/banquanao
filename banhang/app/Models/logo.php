<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\thong_tin_shop;

class logo extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'ma_shop',
        'hinh_logo',
    ];

    public function thong_tin_shop()
    {
        return $this->hasOne(thong_tin_shop::class,'ma_shop','id');
    }

}
