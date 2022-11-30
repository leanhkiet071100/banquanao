@extends('layouts.layoutadmin')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Main -->
    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Product
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('admin.post-san-pham-them') }}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="brand_id" class="col-md-3 text-md-right col-form-label">Nhãn hiệu</label>
                                <div class="col-md-9 col-xl-8">
                                    <select required name="nhanhieu_id" id="brand_id" class="form-control">
                                        <option value="">-- Nhãn hiệu --</option>
                                        @foreach ($lsnhanhieu as $key => $value)
                                            <option value={{ $value->id }}>
                                                {{ $value->ten_nhan_hieu }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-center">
                                        @error('nhanhieu_id')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Loại sản
                                    phẩm</label>
                                <div class="col-md-9 col-xl-8">
                                    <select required name="loaisp_id" id="product_category_id" class="form-control">
                                        <option value="">-- Loại sản phẩm --</option>
                                        @foreach ($lsloaisanpham as $key => $value)
                                            <option value={{ $value->id }}>
                                                {{ $value->ten_loai_san_pham }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-center">
                                        @error('loaisp_id')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="tensp" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="tensp" id="tensp" placeholder="Tên sản phẩm" type="text"
                                        class="form-control" value="{{ old('tensp') }}">
                                    <div class="text-center">
                                        @error('tensp')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="position-relative row form-group">
                                <label for="giasp" class="col-md-3 text-md-right col-form-label">Giá</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="giasp" id="giasp" placeholder="giá" type="text"
                                        class="form-control" value="{{ old('giasp') }}" onChange="format_curency(this);">
                                    <div class="text-center">
                                        @error('giasp')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="trongluong" class="col-md-3 text-md-right col-form-label">Trọng lượng</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="trongluong" id="trongluong" placeholder="Trọng lượng"
                                        type="number" class="form-control" value="{{ old('trongluong') }}">
                                    <div class="text-center">
                                        @error('trongluong')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="soluongkho" class="col-md-3 text-md-right col-form-label">Số lượng kho</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="soluongkho" id="soluongkho" placeholder="Số lượng kho"
                                        type="number" class="form-control" value="{{ old('soluongkho') }}">
                                    <div class="text-center">
                                        @error('soluongkho')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="giamgia" class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="giamgia" id="giamgia" placeholder="giảm giá" type="text"
                                        class="form-control" value="{{ old('giamgia') }}">
                                    <div class="text-center">
                                        @error('giamgia')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="tag" class="col-md-3 text-md-right col-form-label">Tag</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="tag" id="tag" placeholder="Tag" type="text"
                                        class="form-control" value="{{ old('tag') }}">
                                    <div class="text-center">
                                        @error('tag')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="sku" class="col-md-3 text-md-right col-form-label">SKU</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="sku" id="sku" placeholder="SKU" type="text"
                                        class="form-control" value="{{ old('sku') }}">
                                    <div class="text-center">
                                        @error('sku')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="noidung" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea required class="form-control" name="noidung" id="noidung" placeholder="Nội dung"
                                        value="{{ old('noidung') }}">{{ old('noidung') }}</textarea>
                                    <div class="text-center">
                                        @error('noidung')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="mota" class="col-md-3 text-md-right col-form-label">Mô tả</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea required class="form-control ckeditor1" id="mota" name="mota" placeholder="Mô tả"
                                        value="{{ old('mota') }}">{{ old('mota') }}</textarea>
                                    <div class="text-center">
                                        @error('mota')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.san-pham') }}" class="border-0 btn btn-outline-danger mr-1">
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
    </div>
    <!-- End Main -->
@endsection

@section('js')
    <script type="text/javascript">
        function format_curency(a) {
            //xóa dấu phẩy
            a.value = a.value.replaceAll(',','');
            // định dạng tiền
            a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }

        $(document).ready(function() {
            $('#san-pham').addClass('mm-active');
           
        });
        CKEDITOR.replace('mota');
        CKEDITOR.replace('noidung');
    </script>
@endsection
