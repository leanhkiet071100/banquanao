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
                        THÔNG TIN SHOP
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
                        <form method="post" enctype="multipart/form-data" action="">
                            @csrf
                            
                                
                         

                            <div class="position-relative row form-group">
                                <label for="tieu-de" class="col-md-3 text-md-right col-form-label">Tiêu đề</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="tieu-de" id="tieu-de" placeholder="Tiêu đề" type="text"
                                        class="form-control" value="{{ old('tieu-de') }}">
                                    <div class="text-center">
                                        @error('tieu-de')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
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
        $(document).ready(function() {
            $('#li-trang-tinh').addClass('mm-active');
            $('#gioi-thieu').addClass('mm-active');

        });
        CKEDITOR.replace('noidung');
    </script>
@endsection
