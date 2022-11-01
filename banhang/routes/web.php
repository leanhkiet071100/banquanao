<?php

use Illuminate\Support\Facades\Route;

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
    });
        
});


