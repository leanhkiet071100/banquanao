<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminNhanHieuController;
use App\Http\Controllers\Admin\AdminLoaiSanPhamController;
use App\Http\Controllers\Admin\AdminSanPhamController;
use App\Http\Controllers\Admin\AdminBaiVietController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminShopController;
use App\Http\Controllers\Admin\AdminLogoController;
use App\Http\Controllers\Admin\AdminSlideshowController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\SanphamChitietController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShopController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Trang chủ
    Route::get('/', [IndexController::class, 'index'])->name('index');

    //sản phẩm
    Route::get('/san-pham', [SanPhamController::class, 'san_pham'])->name('san-pham');

    // chi tiết sản phẩm
    Route::get('/chi-tiet-san-pham/{id}', [SanphamChitietController::class, 'chi_tiet_san_pham'])->name('chi-tiet-san-pham');

//bài viết
    Route::get('/bai-viet', [BaiVietController::class, 'index'])->name('bai-viet');

    Route::get('/chi-tiet-bai-viet/{id}',  [BaiVietController::class, 'chi_tiet_bai_viet'])->name('chi-tiet-bai-viet');

    Route::get('/menu-bai-viet', [BaiVietController::class, 'menu_bai_viet'])->name('menu_bai_viet');
//hóa đơn
    Route::get('/xuat-hoa-don', function () {
        return view('hoadon.xuathoadon');
    });

//giới thiệu
Route::get('/gioi-thieu', [ShopController::class, 'gioi_thieu'])->name('gioi-thieu');

// giỏ hàng
Route::get('/gio-hang', function () {
    return view('giohang.giohang');
});

//middlewware  kiểm tra đăng nhập hay chưa
Route::middleware('auth')->group(function(){});

//admin

Route::prefix('admin')->group(function(){
    Route::name('admin.')->group(function(){ 

        //sản phẩm
        Route::get('/san-pham', [AdminSanPhamController::class, 'san_pham'])->name('san-pham');
        Route::get('/san-pham-them', [AdminSanPhamController::class, 'get_them_san_pham'])->name('get-san-pham-them');
        Route::post('/san-pham-them', [AdminSanPhamController::class, 'post_them_san_pham'])->name('post-san-pham-them');
        Route::post('/hinh-anh-san-pham/{id}',[AdminSanPhamController::class, 'hinh_anh_san_pham'])->name('hinh-anh-san-pham');
        Route::get('/san-pham-sua/{id}',[AdminSanPhamController::class, 'get_san_pham_sua'])->name('get-san-pham-sua');
        Route::post('/san-pham-sua/{id}',[AdminSanPhamController::class, 'post_san_pham_sua'])->name('post-san-pham-sua');
        Route::delete('/san-pham-xoa/{id}',[AdminSanPhamController::class, 'san_pham_xoa'])->name('san-pham-xoa');
        Route::post('/san-pham-hien/{id}',[AdminSanPhamController::class, 'san_pham_hien'])->name('san-pham-hien');
        Route::post('/san-pham-moi/{id}',[AdminSanPhamController::class, 'san_pham_moi'])->name('san-pham-moi');
        Route::post('/san-pham-noi-bat/{id}',[AdminSanPhamController::class, 'san_pham_noi_bat'])->name('san-pham-noi-bat');
        
        //chi tiết sản phẩm
        Route::get('/chi-tiet-san-pham/{id}', [AdminSanPhamController::class, 'chi_tiet_san_pham'])->name('chi-tiet-san-pham');
        Route::get('/chi-tiet-san-pham-ds/{id}',[AdminSanPhamController::class, 'chi_tiet_san_pham_ds'])->name('chi-tiet-san-pham-ds');
        Route::get('/chi-tiet-san-pham-them/{id}',[AdminSanPhamController::class, 'get_chi_tiet_san_pham_them'])->name('get-chi-tiet-san-pham-them');
        Route::post('/chi-tiet-san-pham-them/{id}',[AdminSanPhamController::class, 'post_chi_tiet_san_pham_them'])->name('post-chi-tiet-san-pham-them');
        Route::get('/chi-tiet-san-pham-sua/{id}',[AdminSanPhamController::class, 'get_chi_tiet_san_pham_sua'])->name('get-chi-tiet-san-pham-sua');
        Route::post('/chi-tiet-san-pham-sua/{id}',[AdminSanPhamController::class, 'post_chi_tiet_san_pham_sua'])->name('post-chi-tiet-san-pham-sua');
        Route::delete('/chi-tiet-san-pham-xoa/{id}',[AdminSanPhamController::class, 'chi_tiet_san_pham_xoa'])->name('chi-tiet-san-pham-xoa');
        Route::post('/chi-tiet-san-pham-hien/{id}',[AdminSanPhamController::class, 'chi_tiet_san_pham_hien'])->name('chi-tiet-san-pham-hien');
        
        //sản phẩm hình ảnh
        Route::get('/chi-tiet-san-pham-hinh-anh/{id}',[AdminSanPhamController::class, 'chi_tiet_san_pham_hinh_anh'])->name('chi-tiet-san-pham-hinh-anh');
        Route::post('/san-pham-them-hinh',[AdminSanPhamController::class, 'them_hinh_san_pham'])->name('them-hinh-san-pham');
        Route::get('/load-hinh-anh-san-pham/{id}',[AdminSanPhamController::class, 'load_hinh_anh_san_pham'])->name('load-hinh-anh-san-pham');
        Route::delete('/xoa-hinh-san-pham/{id}', [AdminSanPhamController::class, 'xoa_hinh_san_pham'])->name('xoa-hinh-san-pham');

        //bài viết
        Route::get('/bai-viet', [AdminBaiVietController::class, 'bai_viet'])->name('bai-viet');
        Route::get('/bai-viet-them', [AdminBaiVietController::class, 'get_them_bai_viet'])->name('get-bai-viet-them');
        Route::post('/bai-viet-them', [AdminBaiVietController::class, 'post_them_bai_viet'])->name('post-bai-viet-them');
        Route::get('/bai-viet-sua/{id}',[AdminBaiVietController::class, 'get_bai_viet_sua'])->name('get-bai-viet-sua');
        Route::post('/bai-viet-sua/{id}',[AdminBaiVietController::class, 'post_bai_viet_sua'])->name('post-bai-viet-sua');
        Route::delete('/bai-viet-xoa/{id}',[AdminBaiVietController::class, 'bai_viet_xoa'])->name('bai-viet-xoa');
        Route::get('/chi-tiet-bai-viet/{id}', [AdminBaiVietController::class, 'chi_tiet_bai_viet'])->name('chi-tiet-bai-viet');
        Route::post('/bai-viet-hien/{id}',[AdminBaiVietController::class, 'bai_viet_hien'])->name('bai-viet-hien');
        Route::post('/bai-viet-moi/{id}',[AdminBaiVietController::class, 'bai_viet_moi'])->name('bai-viet-moi');
        Route::post('/bai-viet-noi-bat/{id}',[AdminBaiVietController::class, 'bai_viet_noi_bat'])->name('bai-viet-noi-bat');

        // nhãn hiệu
        Route::get('/nhan-hieu', [AdminNhanHieuController::class, 'get_nhan_hieu'])->name('get-nhan-hieu');
        Route::get('/load-nhan-hieu', [AdminNhanHieuController::class, 'load_nhan_hieu'])->name('load-nhan-hieu');
        Route::delete('/xoa-nhan-hieu/{id}', [AdminNhanHieuController::class, 'xoa_nhan_hieu'])->name('xoa-nhan-hieu');
        Route::post('/post-nhan-hieu-them',[AdminNhanHieuController::class, 'post_them_nhan_hieu'])->name('post-nhan-hieu-them');
        Route::get('/get-nhan-hieu-them',[AdminNhanHieuController::class, 'get_them_nhan_hieu'])->name('get-nhan-hieu-them');
        Route::get('/get-nhan-hieu-sua/{id}', [AdminNhanHieuController::class, 'get_sua_nhan_hieu'])->name('get-nhan-hieu-sua');
        Route::post('/post-nhan-hieu-sua/{id}',[AdminNhanHieuController::class, 'post_sua_nhan_hieu'])->name('post-nhan-hieu-sua');
        Route::post('/nhan-hieu-hien/{id}',[AdminNhanHieuController::class, 'nhan_hieu_hien'])->name('nhan-hieu-hien');

        // loại sản phẩm
        Route::get('/loai-san-pham', [AdminLoaiSanPhamController::class, 'get_loai_san_pham'])->name('get-loai-san-pham');
        Route::get('/load-loai-san-pham', [AdminLoaiSanPhamController::class, 'load_loai_san_pham'])->name('load-loai-san-pham');
        Route::get('/get-loai-san-pham-them',[AdminLoaiSanPhamController::class, 'get_them_loai_san_pham'])->name('get-loai-san-pham-them');
        Route::post('/post-loai-san-pham-them',[AdminLoaiSanPhamController::class, 'post_them_loai_san_pham'])->name('post-loai-san-pham-them');
        Route::get('/get-loai-san-pham-sua/{id}', [AdminLoaiSanPhamController::class, 'get_sua_loai_san_pham'])->name('get-loai-san-pham-sua');
        Route::post('/post-loai-san-pham-sua/{id}', [AdminLoaiSanPhamController::class, 'post_sua_loai_san_pham'])->name('post-loai-san-pham-sua');
        Route::delete('/xoa-loai-san-pham/{id}', [AdminLoaiSanPhamController::class, 'xoa_loai_san_pham'])->name('xoa-loai-san-pham');
        Route::post('/loai-san-pham-hien/{id}',[AdminLoaiSanPhamController::class, 'loai_san_pham_hien'])->name('loai-san-pham-hien');
        Route::post('/loai-san-pham-moi/{id}',[AdminLoaiSanPhamController::class, 'loai_san_pham_moi'])->name('loai-san-pham-moi');
        Route::post('/loai-san-pham-noi-bat/{id}',[AdminLoaiSanPhamController::class, 'loai_san_pham_noi_bat'])->name('loai-san-pham-noi-bat');
        Route::get('/thay-doi-chu/{str}',[AdminLoaiSanPhamController::class, 'vn_to_str'])->name('thay-doi-chu');

        //logo
        Route::get('/logo',[AdminLogoController::class, 'logo'])->name('logo');
        Route::post('/logo-them',[AdminLogoController::class, 'logo_them'])->name('logo-them');
        Route::post('/logo-sua/{id}',[AdminLogoController::class, 'logo_sua'])->name('logo-sua');
        //shop
        Route::get('/thong-tin-shop',[AdminshopController::class, 'thong_tin_shop'])->name('thong-tin-shop');
        Route::post('/thong-tin-shop-them',[AdminshopController::class, 'thong_tin_shop_them'])->name('thong-tin-shop-them');
        Route::post('/thong-tin-shop-sua/{id}',[AdminshopController::class, 'thong_tin_shop_sua'])->name('thong-tin-shop-sua');
        

        //banner
        Route::get('/banner',[AdminBannerController::class, 'banner'])->name('banner');
        Route::post('/banner-them',[AdminBannerController::class, 'banner_them'])->name('banner-them');
        Route::post('/banner-sua/{id}',[AdminBannerController::class, 'banner_sua'])->name('banner-sua');

        //
         Route::get('/slideshow',[AdminslideshowController::class, 'slideshow'])->name('slideshow');
    });

        
});


