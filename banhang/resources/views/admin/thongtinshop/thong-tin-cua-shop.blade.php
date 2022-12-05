@extends('layouts.layoutadmin')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    @if (session()->has('success'))
        <script>
            alert('{{ session()->get('success') }}')
        </script>
    @endif
    <!-- Main -->
    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        THÔNG TIN SHOP
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($shop != null)
            {{-- sửa thông tin --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data"
                                action="{{ route('admin.thong-tin-shop-sua',['id'=>$shop->id]) }}">
                                @csrf
                                <div class="position-relative row form-group">
                                    <label for="ten-shop" class="col-md-3 text-md-right col-form-label">Tên shop</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="ten-shop" id="ten-shop" placeholder="Tên shop" type="text"
                                            class="form-control" value="{{ old('ten-shop') ?? $shop->ten_shop }}">
                                        <div class="text-center">
                                            @error('ten-shop')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="position-relative row form-group">
                                    <label for="so-dien-thoai" class="col-md-3 text-md-right col-form-label">số điện
                                        thoại</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="so-dien-thoai" id="so-dien-thoai" placeholder="Số điện thoại"
                                            type="tel" class="form-control"
                                            value="{{ old('so-dien-thoai') ?? $shop->so_dien_thoai }}"
                                            onchange="format_curency(this);">
                                        {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}

                                        <div class="text-center">
                                            @error('so-dien-thoai')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="zalo" class="col-md-3 text-md-right col-form-label">Zalo</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input name="zalo" id="zalo" placeholder="zalo" type="text"
                                            class="form-control" value="{{ old('zalo') ?? $shop->zalo }}">
                                        <div class="text-center">
                                            @error('zalo')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="email" class="col-md-3 text-md-right col-form-label">email</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="email" id="email" placeholder="email" type="email"
                                            class="form-control" value="{{ old('email') ?? $shop->email }}">
                                        <div class="text-center">
                                            @error('email')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="dia-chi" class="col-md-3 text-md-right col-form-label">Địa chỉ</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="dia-chi" id="dia-chi" placeholder="Địa chỉ" type="text"
                                            class="form-control" value="{{ old('dia-chi') ?? $shop->dia_chi }}">
                                        <div class="text-center">
                                            @error('dia-chi')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="thoi-gian-mo" class="col-md-3 text-md-right col-form-label">Thời gian
                                        mở</label>
                                    <div class="col-md-9 col-xl-7">
                                        <input required name="thoi-gian-mo" id="thoi-gian-mo" placeholder="Thời gian mở"
                                            type="text" class="form-control"
                                            value="{{ old('thoi-gian-mo') ?? date('H:i', strtotime($shop->thoi_gian_mo)); }}"
                                            onfocus="(this.type='time')" id="thoi-gian-mo" onchange="thoi_gian_mo()">
                                            
                                        <div class="text-center">
                                            @error('thoi-gian-mo')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1 ">
                                        <input disabled placeholder="00:00" type="text" class="form-control text-center"
                                            value="{{  date('H:i', strtotime($shop->thoi_gian_mo)) }}" id="value-thoi-gian-mo">
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="thoi-gian-dong" class="col-md-3 text-md-right col-form-label">Thời gian
                                        đóng</label>
                                    <div class="col-md-9 col-xl-7">
                                        <input required name="thoi-gian-dong" id="thoi-gian-dong"
                                            placeholder="Thời gian đóng" type="text" class="form-control"
                                            value="{{ old('thoi-gian-dong') ??  date('H:i', strtotime($shop->thoi_gian_mo)) }}"
                                            onfocus="(this.type='time')" id="thoi-gian-dong" onchange="thoi_gian_dong()">
                                        <div class="text-center">
                                            @error('thoi-gian-dong')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1 ">
                                        <input disabled placeholder="00:00" type="text"
                                            class="form-control text-center" value="{{  date('H:i', strtotime($shop->thoi_gian_mo)) }}"
                                            id="value-thoi-gian-dong">
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="noidung" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                                    <div class="col-md-9 col-xl-8">
                                        <textarea required class="form-control" name="noidung" id="noidung" placeholder="Nội dung" value="">{{ old('noidung') ?? $shop->noi_dung }}</textarea>
                                        <div class="text-center">
                                            @error('noidung')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="nhung-ban-do" class="col-md-3 text-md-right col-form-label">Nhúng bản
                                        đồ</label>
                                    <div class="col-md-9 col-xl-8">
                                        <textarea required class="form-control ckeditor1" id="nhung-ban-do" name="nhung-ban-do" placeholder="Mô tả"
                                            value="">{{ old('nhung-ban-do') ?? $shop->ban_do }}</textarea>
                                        <div class="text-center">
                                            @error('nhung-ban-do')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group mb-1">
                                    <div class="col-md-9 col-xl-8 offset-md-2">
                                        <a href="{{ route('admin.san-pham') }}"
                                            class="border-0 btn btn-outline-danger mr-1">
                                            <span class="btn-icon-wrapper pr-1 opacity-8">
                                                <i class="fa fa-times fa-w-20"></i>
                                            </span>
                                            <span>Hủy</span>
                                        </a>

                                        <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                            <span class="btn-icon-wrapper pr-2 opacity-8">
                                                <i class="fa fa-download fa-w-20"></i>
                                            </span>
                                            <span>Lưu</span>
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Kết thúc sửa thông tin --}}
        @else
            {{-- Them thông tin --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data"
                                action="{{ route('admin.thong-tin-shop-them') }}">
                                @csrf
                                <div class="position-relative row form-group">
                                    <label for="ten-shop" class="col-md-3 text-md-right col-form-label">Tên shop</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="ten-shop" id="ten-shop" placeholder="Tên shop"
                                            type="text" class="form-control" value="{{ old('ten-shop') }}">
                                        <div class="text-center">
                                            @error('ten-shop')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="position-relative row form-group">
                                    <label for="so-dien-thoai" class="col-md-3 text-md-right col-form-label">số điện
                                        thoại</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="so-dien-thoai" id="so-dien-thoai"
                                            placeholder="Số điện thoại" type="tel" class="form-control"
                                            value="{{ old('so-dien-thoai') }}" onchange="format_curency(this);">
                                        {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}

                                        <div class="text-center">
                                            @error('so-dien-thoai')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="zalo" class="col-md-3 text-md-right col-form-label">Zalo</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input name="zalo" id="zalo" placeholder="zalo" type="text"
                                            class="form-control" value="{{ old('zalo') }}">
                                        <div class="text-center">
                                            @error('zalo')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="email" class="col-md-3 text-md-right col-form-label">email</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="email" id="email" placeholder="email" type="email"
                                            class="form-control" value="{{ old('email') }}">
                                        <div class="text-center">
                                            @error('email')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="dia-chi" class="col-md-3 text-md-right col-form-label">Địa chỉ</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="dia-chi" id="dia-chi" placeholder="Địa chỉ"
                                            type="text" class="form-control" value="{{ old('dia-chi') }}">
                                        <div class="text-center">
                                            @error('dia-chi')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="thoi-gian-mo" class="col-md-3 text-md-right col-form-label">Thời gian
                                        mở</label>
                                    <div class="col-md-9 col-xl-7">
                                        <input required name="thoi-gian-mo" id="thoi-gian-mo" placeholder="Thời gian mở"
                                            type="text" class="form-control" value="{{ old('thoi-gian-mo') }}"
                                            onfocus="(this.type='time')" id="thoi-gian-mo" onchange="thoi_gian_mo()">
                                        <div class="text-center">
                                            @error('thoi-gian-mo')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1 ">
                                        <input disabled placeholder="00:00" type="text"
                                            class="form-control text-center" value="" id="value-thoi-gian-mo">
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="thoi-gian-dong" class="col-md-3 text-md-right col-form-label">Thời gian
                                        đóng</label>
                                    <div class="col-md-9 col-xl-7">
                                        <input required name="thoi-gian-dong" id="thoi-gian-dong"
                                            placeholder="Thời gian đóng" type="text" class="form-control"
                                            value="{{ old('thoi-gian-dong') }}" onfocus="(this.type='time')"
                                            id="thoi-gian-dong" onchange="thoi_gian_dong()">
                                        <div class="text-center">
                                            @error('thoi-gian-dong')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1 ">
                                        <input disabled placeholder="00:00" type="text"
                                            class="form-control text-center" value="" id="value-thoi-gian-dong">
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="noidung" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                                    <div class="col-md-9 col-xl-8">
                                        <textarea required class="form-control" name="noidung" id="noidung" placeholder="Nội dung" value="">{{ old('noidung') }}</textarea>
                                        <div class="text-center">
                                            @error('noidung')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="nhung-ban-do" class="col-md-3 text-md-right col-form-label">Nhúng bản
                                        đồ</label>
                                    <div class="col-md-9 col-xl-8">
                                        <textarea required class="form-control ckeditor1" id="nhung-ban-do" name="nhung-ban-do" placeholder="Mô tả"
                                            value="">{{ old('nhung-ban-do') }}</textarea>
                                        <div class="text-center">
                                            @error('nhung-ban-do')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group mb-1">
                                    <div class="col-md-9 col-xl-8 offset-md-2">
                                        <a href="{{ route('admin.san-pham') }}"
                                            class="border-0 btn btn-outline-danger mr-1">
                                            <span class="btn-icon-wrapper pr-1 opacity-8">
                                                <i class="fa fa-times fa-w-20"></i>
                                            </span>
                                            <span>Hủy</span>
                                        </a>

                                        <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                            <span class="btn-icon-wrapper pr-2 opacity-8">
                                                <i class="fa fa-download fa-w-20"></i>
                                            </span>
                                            <span>Lưu</span>
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Kết thúc thêm thông tin --}}
        @endif
    </div>

    <!-- End Main -->
@endsection



@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#thong-tin-shop').addClass('mm-active');
        });
        CKEDITOR.replace('noidung');

        function thoi_gian_dong() {
            var thoi_gian_dong = document.getElementById('thoi-gian-dong');
            // alert(thoi_gian_dong.value);
            var value_hoi_gian_dong = document.getElementById('value-thoi-gian-dong');
            value_hoi_gian_dong.value = thoi_gian_dong.value;
        }

        function thoi_gian_mo() {
            var thoi_gian_mo = document.getElementById('thoi-gian-mo');
            // alert(thoi_gian_dong.value);
            var value_hoi_gian_mo = document.getElementById('value-thoi-gian-mo');
            value_hoi_gian_mo.value = thoi_gian_mo.value;
        }
    </script>

@endsection
