<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminNhanHieuController;
use App\Http\Controllers\Admin\AdminLoaiSanPhamController;
use App\Http\Controllers\Admin\AdminSanPhamController;


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
Route::get('/', function () {
    return view('trangchu.index');
});

//sản phẩm
Route::get('/san-pham', function () {
    return view('sanpham.dssanpham');
});

Route::get('/chi-tiet-san-pham', function () {
    return view('sanpham.chitietsanpham');
});

//bài viết
Route::get('/bai-viet', function () {
    return view('baiviet.dsbaiviet');
});

Route::get('/chi-tiet-bai-viet', function () {
    return view('baiviet.chitietbaiviet');
});

//hóa đơn
Route::get('/xuat-hoa-don', function () {
    return view('hoadon.xuathoadon');
});

//giới thiệu
Route::get('/gioi-thieu', function () {
    return view('thongtinshop.gioithieu');
});

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
        //chi tiết sản phẩm
        Route::get('/chi-tiet-san-pham/{id}', [AdminSanPhamController::class, 'chi_tiet_san_pham'])->name('chi-tiet-san-pham');
        Route::get('/chi-tiet-san-pham-ds/{id}',[AdminSanPhamController::class, 'chi_tiet_san_pham_ds'])->name('chi-tiet-san-pham-ds');
        Route::get('/chi-tiet-san-pham-them/{id}',[AdminSanPhamController::class, 'get_chi_tiet_san_pham_them'])->name('get-chi-tiet-san-pham-them');
        //sản phẩm hình ảnh
        Route::get('/chi-tiet-san-pham-hinh-anh/{id}',[AdminSanPhamController::class, 'chi_tiet_san_pham_hinh_anh'])->name('chi-tiet-san-pham-hinh-anh');
        Route::post('/san-pham-them-hinh',[AdminSanPhamController::class, 'them_hinh_san_pham'])->name('them-hinh-san-pham');
        Route::get('/load-hinh-anh-san-pham/{id}',[AdminSanPhamController::class, 'load_hinh_anh_san_pham'])->name('load-hinh-anh-san-pham');
        Route::delete('/xoa-hinh-san-pham/{id}', [AdminSanPhamController::class, 'xoa_hinh_san_pham'])->name('xoa-hinh-san-pham');
        //bài viết
        Route::get('/bai-viet', function () { return view('admin.baiviet.baiviet-ds');});

        // nhãn hiệu
        Route::get('/nhan-hieu', [AdminNhanHieuController::class, 'get_nhan_hieu'])->name('get-nhan-hieu');
        Route::get('/load-nhan-hieu', [AdminNhanHieuController::class, 'load_nhan_hieu'])->name('load-nhan-hieu');
        Route::delete('/xoa-nhan-hieu/{id}', [AdminNhanHieuController::class, 'xoa_nhan_hieu'])->name('xoa-nhan-hieu');
        Route::post('/post-nhan-hieu-them',[AdminNhanHieuController::class, 'post_them_nhan_hieu'])->name('post-nhan-hieu-them');
        Route::get('/get-nhan-hieu-them',[AdminNhanHieuController::class, 'get_them_nhan_hieu'])->name('get-nhan-hieu-them');
        Route::get('/get-nhan-hieu-sua/{id}', [AdminNhanHieuController::class, 'get_sua_nhan_hieu'])->name('get-nhan-hieu-sua');
        Route::post('/post-nhan-hieu-sua/{id}',[AdminNhanHieuController::class, 'post_sua_nhan_hieu'])->name('post-nhan-hieu-sua');

        // loại sản phẩm
        Route::get('/loai-san-pham', [AdminLoaiSanPhamController::class, 'get_loai_san_pham'])->name('get-loai-san-pham');
        Route::get('/load-loai-san-pham', [AdminLoaiSanPhamController::class, 'load_loai_san_pham'])->name('load-loai-san-pham');
        Route::get('/get-loai-san-pham-them',[AdminLoaiSanPhamController::class, 'get_them_loai_san_pham'])->name('get-loai-san-pham-them');
        Route::post('/post-loai-san-pham-them',[AdminLoaiSanPhamController::class, 'post_them_loai_san_pham'])->name('post-loai-san-pham-them');
        Route::get('/get-loai-san-pham-sua/{id}', [AdminLoaiSanPhamController::class, 'get_sua_loai_san_pham'])->name('get-loai-san-pham-sua');
        Route::post('/post-loai-san-pham-sua/{id}', [AdminLoaiSanPhamController::class, 'post_sua_loai_san_pham'])->name('post-loai-san-pham-sua');
        Route::delete('/xoa-loai-san-pham/{id}', [AdminLoaiSanPhamController::class, 'xoa_loai_san_pham'])->name('xoa-loai-san-pham');
    });

        
});


