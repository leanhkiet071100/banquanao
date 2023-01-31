<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminNhanHieuController;
use App\Http\Controllers\Admin\AdminLoaiSanPhamController;
use App\Http\Controllers\Admin\AdminSanPhamController;
use App\Http\Controllers\Admin\AdminBaiVietController;
use App\Http\Controllers\Admin\AdminShopController;
use App\Http\Controllers\Admin\AdminSlideshowController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\SanphamChitietController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\HoadonController;
use App\Http\Controllers\NguoidungController;
use App\Models\gio_hang;




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
//   Route::middleware('auth')->group(function(){
//          Route::get('/dang-ki', [IndexController::class, 'dang_ki'])->name('dang-ki');
//     });


    //middlewware  kiểm tra quyền 
   

    //view composer
    view()->composer(['*'], function ($view) {
        // Đếm số lượng giỏ hàng
        if(Auth::user()!= null ){
            $iduser = Auth::user()->id;
            $count = gio_hang::where('ma_nguoi_dung','=',$iduser)->count();
        }
        else{ $count = null;}

        $view->with('count',$count);
    });

    //admin đăng nhập 
    Route::get('/admin', [IndexController::class, 'login_admin'])->name('admin');
    Route::get('/admin/login', [IndexController::class, 'login_admin'])->name('login-admin');
    Route::post('/admin/login', [IndexController::class, 'post_login_admin'])->name('post-login-admin');
    
    //đăng nhập
    Route::get('/dang-nhap', [IndexController::class, 'dang_nhap'])->name('dang-nhap');
    Route::post('/dang-nhap', [IndexController::class, 'post_dang_nhap'])->name('post-dang-nhap');

    //đăng kí
    Route::get('/dang-ki', [IndexController::class, 'dang_ki'])->name('dang-ki');
    Route::post('/dang-ki', [IndexController::class, 'post_dang_ki'])->name('post-dang-ki');
    Route::get('/kich-hoat/{id}/{token}', [IndexController::class, 'kich_hoat'])->name('kich-hoat');

    //quên mật khẩu
    Route::get('/quen-mat-khau', [IndexController::class, 'quen_mat_khau'])->name('quen-mat-khau');
    Route::post('/quen-mat-khau', [IndexController::class, 'post_quen_mat_khau'])->name('post-quen-mat-khau');
    //đăng xuất
    Route::get('/dang-xuat', [IndexController:: class,'dang_xuat'])->name('dang_xuat');

    //trang cá nhân
    Route::prefix('tai-khoan')->group(function(){
        Route::name('tai-khoan.')->group(function(){ 
            // load trang người dung
            Route::get('/', [NguoidungController::class, 'index'])->name('tai-khoan');
            // thay đổi thông tin tài khoản
            Route::post('/', [NguoidungController::class, 'thay_doi_tai_khoan'])->name('post-tai-khoan');
            // đổi  mật khẩu
            Route::get('/doi-mat-khau', [NguoidungController::class, 'doi_mat_khau'])->name('doi-mat-khau');
            Route::post('/doi-mat-khau', [NguoidungController::class, 'post_doi_mat_khau'])->name('post-doi-mat-khau');
            // load địa chỉ
            Route::get('/dia-chi', [NguoidungController::class, 'dia_chi'])->name('dia-chi');
            //load form thêm địa chỉ
            Route::get('/get-dia-chi', [NguoidungController::class, 'get_dia_chi'])->name('get-dia-chi');
            // thêm địa chỉ
            Route::post('/post-dia-chi', [NguoidungController::class, 'post_dia_chi'])->name('post-dia-chi');
            //load form sửa địa chỉ
            Route::get('/get-dia-chi-sua/{id}', [NguoidungController::class, 'get_dia_chi_sua'])->name('get-dia-chi-sua');
            //sửa địa chỉ
            Route::post('/post-dia-chi-sua/{id}', [NguoidungController::class, 'post_dia_chi_sua'])->name('post-dia-chi-sua');
            //thiết lập địa chỉ mặc định
            Route::post('/thiet-lap-dia-chi', [NguoidungController::class, 'thiet_lap_dia_chi'])->name('thiet-lap-dia-chi');
            //load tỉnh thành Việt Nam
            Route::post('/get-load-huyen', [NguoidungController::class, 'get_load_huyen'])->name('get-load-huyen');
            Route::post('/get-load-xa', [NguoidungController::class, 'get_load_xa'])->name('get-load-xa');
        }); 
    });

    // Trang chủ
    Route::get('/', [IndexController::class, 'index'])->name('index');
    //sản phẩm
    Route::get('/san-pham', [SanPhamController::class, 'san_pham'])->name('san-pham');
    // chi tiết sản phẩm
    Route::get('/chi-tiet-san-pham/{id}', [SanphamChitietController::class, 'chi_tiet_san_pham'])->name('chi-tiet-san-pham');
    //bài viết
    Route::get('/bai-viet', [BaiVietController::class, 'index'])->name('bai-viet');
    Route::get('/chi-tiet-bai-viet/{id}',  [BaiVietController::class, 'chi_tiet_bai_viet'])->name('chi-tiet-bai-viet');
    Route::get('/menu-bai-viet', [BaiVietController::class, 'menu_bai_viet'])->name('menu-bai-viet');
    //bình luận bài viết
    Route::post('/binh-luan-bai-viet/{id}',[BaiVietController::class, 'binh_luan_bai_viet'])->name('binh-luan-bai-viet');
    Route::post('/load-binh-luan-bai-viet',[BaiVietController::class, 'load_binh_luan'])->name('load-binh-luan-bai-viet');
    //giới thiệu
    Route::get('/gioi-thieu', [ShopController::class, 'gioi_thieu'])->name('gioi-thieu');
    // giỏ hàng
    Route::get('/gio-hang', [GioHangController::class, 'gio_hang'])->name('gio-hang');
    Route::post('/them-gio-hang', [GioHangController::class, 'them_gio_hang'])->name('them-gio-hang');
    //hóa đơn
    Route::get('/xuat-hoa-don', [HoadonController::class, 'xuat_hoa_don'])->name('xuat-hoa-don');

 //Route::middleware('login')->group(function(){
    //admin
    Route::prefix('admin')->group(function(){
        Route::name('admin.')->group(function(){ 
            //login 
            Route::get('/logout', [AdminLoginController:: class,'logout_admin'])->name('logout_admin');

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
            // bình luận bài viết
            Route::get('/binh-luan-bai-viet', [AdminBaiVietController::class, 'binh_luan_bai_viet'])->name('binh-luan-bai-viet');
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
            Route::get('/logo',[AdminShopController::class, 'logo'])->name('logo');
            Route::post('/logo-them',[AdminShopController::class, 'logo_them'])->name('logo-them');
            Route::post('/logo-sua/{id}',[AdminShopController::class, 'logo_sua'])->name('logo-sua');

            //shop
            Route::get('/thong-tin-shop',[AdminshopController::class, 'thong_tin_shop'])->name('thong-tin-shop');
            Route::post('/thong-tin-shop-them',[AdminshopController::class, 'thong_tin_shop_them'])->name('thong-tin-shop-them');
            Route::post('/thong-tin-shop-sua/{id}',[AdminshopController::class, 'thong_tin_shop_sua'])->name('thong-tin-shop-sua');
            
            //banner
            Route::get('/banner',[AdminShopController::class, 'banner'])->name('banner');
            Route::post('/banner-them',[AdminShopController::class, 'banner_them'])->name('banner-them');
            Route::post('/banner-sua/{id}',[AdminShopController::class, 'banner_sua'])->name('banner-sua');

            //slideshow
            Route::get('/slideshow',[AdminslideshowController::class, 'slideshow'])->name('slideshow');
            Route::get('/slideshow-them',[AdminslideshowController::class, 'get_slideshow_them'])->name('get-slideshow-them');
            Route::post('/slideshow-them',[AdminslideshowController::class, 'post_slideshow_them'])->name('post-slideshow-them');
            Route::get('/slideshow-sua/{id}',[AdminslideshowController::class, 'get_slideshow_sua'])->name('get-slideshow-sua');
            Route::post('/slideshow-sua/{id}',[AdminslideshowController::class, 'post_slideshow_sua'])->name('post-slideshow-sua');
            Route::delete('/slideshow-xoa/{id}',[AdminslideshowController::class, 'slideshow_xoa'])->name('slideshow-xoa');
            Route::post('/slideshow-hien/{id}',[AdminslideshowController::class, 'slideshow_hien'])->name('slideshow-hien');
            Route::post('/slideshow-noi-bat/{id}',[AdminslideshowController::class, 'slideshow_noi_bat'])->name('slideshow-noi-bat');
        });

            
    });
 // });

