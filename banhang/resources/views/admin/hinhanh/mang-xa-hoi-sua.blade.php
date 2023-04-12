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
                        MẠNG XÃ HỘI
                        <div class="page-title-subheading">
                            Cập nhật mạng xã hội
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"
                            action="{{ route('admin.post-mang-xa-hoi-sua', ['id' => $mang_xa_hoi->id]) }}">
                            @csrf

                            <div class="position-relative row form-group">
                                <label for="" class="col-md-3 text-md-right col-form-label">Hình</label>
                                <div class="col-md-9 col-xl-8">
                                    <ul class="text-nowrap" id="images">
                                        <li class="float-left d-inline-block mr-2 mb-2" style="width: 25%;">

                                            <div style="width: 100%; max-height: 100%; overflow: hidden;"
                                                class="hinh-mang-xa-hoi">
                                                @if ($mang_xa_hoi->hinh_anh != null)
                                                    <img style="width: 100%; cursor: pointer;" class="thumbnail"
                                                        data-toggle="tooltip" title="Click to add image"
                                                        data-placement="bottom" src="{{ URL($mang_xa_hoi->hinh_anh) }}"
                                                        alt="Add Image">
                                                @else
                                                    <img style="width: 100%; cursor: pointer;" class="thumbnail"
                                                        data-toggle="tooltip" title="Click to add image"
                                                        data-placement="bottom" src="{{URL('admin/assets/images/add-image-icon.jpg')}}"
                                                        alt="Add Image">
                                                @endif


                                                <input name="hinh-mang-xa-hoi" type="file" onchange="changeImg(this);"
                                                    accept="image/x-png,image/gif,image/jpeg" id="hinh-mang-xa-hoi"
                                                    class="image form-control-file hinh-mang-xa-hoi" style="display: none;">
                                            </div>


                                        </li>
                                    </ul>
                                    <div class="text-center">
                                        @error('hinh-mang-xa-hoi')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="position-relative row form-group">
                                <label for="tieu-de" class="col-md-3 text-md-right col-form-label">Tiêu đề</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="tieu-de" id="tieu-de" placeholder="tiêu đề" type="text"
                                        class="form-control" value="{{ old('tieu-de') ?? $mang_xa_hoi->tieu_de }}">
                                    <div class="text-center">
                                        @error('tieu-de')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="position-relative row form-group">
                                <label for="link" class="col-md-3 text-md-right col-form-label">link</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="link" id="link" placeholder="https://www.google.com"
                                        type="url" class="form-control" value="{{ old('link') ?? $mang_xa_hoi->link }}">
                                    <div class="text-center">
                                        @error('link')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="link" class="col-md-3 text-md-right col-form-label">Hiện</label>
                                <div class="col-md-9 col-xl-8">
                                    <input class="form-check-input them-slideshow-check" type="checkbox" value="" id="" name="check-hien" @if ($mang_xa_hoi->hien == 1) checked @endif>
                                    
                                </div>
                               
                            </div>
                            
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.mang-xa-hoi') }}" class="border-0 btn btn-outline-danger mr-1">
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
            $('#mang-xa-hoi').addClass('mm-active');
            $('#li-hinh-anh').addClass('mm-active');

        });
    </script>
@endsection
