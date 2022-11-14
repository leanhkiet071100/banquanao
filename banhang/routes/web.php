<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminNhanHieuController;
use App\Http\Controllers\Admin\AdminLoaiSanPhamController;


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
        Route::get('/san-pham', function () {
            return view('admin.sanpham.sanpham-ds');
        });
        //bài viết
        Route::get('/bai-viet', function () {
            return view('admin.baiviet.baiviet-ds');
        });

        Route::get('/chi-tiet-bai-viet', function () {
            return view('admin.baiviet.baiviet-chitiet');
        });

        Route::get('/sua-bai-viet', function () {
            return view('admin.baiviet.baiviet-sua');
        });

        Route::get('/san-pham-hinh', function () {
            return view('admin.sanpham.sanpham-hinh');
        });

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


