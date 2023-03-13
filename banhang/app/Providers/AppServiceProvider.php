<?php

namespace App\Providers;
    
use Illuminate\Support\ServiceProvider;
use App\Models\baiviet;
use App\Models\sanpham;
use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\logo;
use App\Models\slideshow;
use App\Models\hinh_anh;
use App\Models\thong_tin_shop;
use App\Models\trang_tinh;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(IndexController $index)
    {
        Paginator::useBootstrapFive();
        $lsloaisanpham = loai_san_pham::where('hien','=',1)->get();
        $loaibaiviet = baiviet::select('loai_bai_viet')->distinct('loai_bai_viet')->get();
        $lsbaivietmoi = baiviet::where('hien','=',1)->where('moi','=',1)->orderBy('created_at', 'DESC')->paginate(3);
        //$hinh_anh = logo::orderBy('id')->first();
        $shop = thong_tin_shop::orderBy('id')->first();
        $slideshow = hinh_anh::where('hien','=',1)->where('loai','=',1)->orderBy('created_at')->get();
        $mang_xa_hoi = hinh_anh::where('hien','=',1)->where('loai','=',2)->orderBy('created_at')->get();
        $footer =  trang_tinh::where('loai','=',1)->first();
        $chinh_sach =  trang_tinh::where('loai','=',2)->first();
        $slogan =  trang_tinh::where('loai','=',3)->first();
        View::share(['lsloaisanpham'=>$lsloaisanpham,
                    'loaibaiviet'=>$loaibaiviet,
                    'lsbaivietmoi'=>$lsbaivietmoi,
                    //'hinh_anh'=>$hinh_anh,
                    'shop'=>$shop,
                    'slideshow'=>$slideshow,
                    'mang_xa_hoi'=>$mang_xa_hoi,
                    'footer'=>$footer,
                    'chinh_sach'=>$chinh_sach,
                    'slogan'=>$slogan,
                    ]);
    }
    
}
