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
                        Thêm bài viết
                        <div class="page-title-subheading">
                            Thêm bài viết mới
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('admin.post-bai-viet-them') }}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="" class="col-md-3 text-md-right col-form-label">Hình ảnh</label>
                                <div class="col-md-9 col-xl-8">
                                    <ul class="text-nowrap" id="images">
                                        <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">

                                            <div style="width: 100%; max-height: 100%; overflow: hidden;"
                                                class="hinh-bai-viet">
                                                <img style="width: 100%; cursor: pointer;" class="thumbnail"
                                                    data-toggle="tooltip" title="Click to add image" data-placement="bottom"
                                                    src="{{ old('hinhbaiviet') ?? 'assets/images/add-image-icon.jpg'}}" alt="Add Image">

                                                <input name="hinhbaiviet" type="file" onchange="changeImg(this);"
                                                    accept="image/x-png,image/gif,image/jpeg" id="hinhbaiviet"
                                                    class="image form-control-file bai-viet-hinh" style="display: none;">
                                            </div>

                                        </li>
                                    </ul>
                                    <div class="text-center">
                                        @error('hinhbaiviet')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Loại bài
                                    viết</label>
                                <div class="col-md-9 col-xl-8">
                                    {{-- <select required name="loaisp_id" id="product_category_id" class="form-control">
                                        <option value="">-- Loại sản phẩm --</option>
                                        @foreach ($lsloaisanpham as $key => $value)
                                            <option value={{ $value->id }}>
                                                {{ $value->ten_loai_san_pham }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    <input required name="loaibaiviet" id="loaibaiviet" placeholder="Loại bài viêt"
                                        type="text" class="form-control" value="{{ old('loaibaiviet') }}">
                                    <div class="text-center">
                                        @error('loaibaiviet')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="tieude" class="col-md-3 text-md-right col-form-label">Tiêu đề</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="tieude" id="tieude" placeholder="Tiêu đề" type="text"
                                        class="form-control" value="{{ old('tieude') }}">
                                    <div class="text-center">
                                        @error('tieude')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="position-relative row form-group">
                                <label for="phude" class="col-md-3 text-md-right col-form-label">Phụ đề</label>
                                <div class="col-md-9 col-xl-8">
                                    <input  name="phude" id="phude" placeholder="Phụ đề" type="text"
                                        class="form-control" value="{{ old('phude') }}">
                                    <div class="text-center">
                                        @error('phude')
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

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.bai-viet') }}" class="border-0 btn btn-outline-danger mr-1">
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

        $(document).ready(function() {
            $('#bai-viet').addClass('mm-active');
            $('#li-bai-viet').addClass('mm-active');
        });
        CKEDITOR.replace('noidung');
    </script>
@endsection
