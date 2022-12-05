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
        <input type="hidden" id="idsp" value="">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        LOGO
                    </div>
                </div>
            </div>
        </div>
        @if ($logo != null)
            <form action="{{ route('admin.logo-sua', ['id' => $logo->id]) }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="position-relative row form-group">
                                    <label for="" class="col-md-3 text-md-right col-form-label">Logo</label>
                                    <div class="col-md-9 col-xl-8">
                                        <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                            <form method="post" enctype="multipart/form-data" data-url="">
                                                @csrf
                                                <div style="width: 100%; max-height: 220px; overflow: hidden;">

                                                    <img style="width: 100%; cursor: pointer;" class="thumbnail"
                                                        data-toggle="tooltip" title="Click to add image"
                                                        data-placement="bottom" src="{{URL(($logo->hinh_logo)??'admin/assets/images/add-image-icon.jpg')}}"
                                                        alt="Add Image">

                                                    <input name="image" type="file" onchange="changeImg(this);"
                                                        accept="image/x-png,image/gif,image/jpeg"
                                                        class="image form-control-file" style="display: none;">

                                                    <input type="hidden" name="product_id" value="">
                                                </div>
                                            </form>
                                        </li>
                                    </div>
                                </div>

                                <div class="position-relative row form-group mb-1">
                                    <div class="col-md-9 col-xl-8 offset-md-3">
                                        <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                            <span class="btn-icon-wrapper pr-2 opacity-8">
                                                <i class="fa fa-download fa-w-20"></i>
                                            </span>
                                            <span>Lưu</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <form action="{{ route('admin.logo-them') }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="position-relative row form-group">
                                    <label for="" class="col-md-3 text-md-right col-form-label">Logo</label>
                                    <div class="col-md-9 col-xl-8">
                                        <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                            <form method="post" enctype="multipart/form-data" data-url="">
                                                @csrf
                                                <div style="width: 100%; max-height: 220px; overflow: hidden;">

                                                    <img style="width: 100%; cursor: pointer;" class="thumbnail"
                                                        data-toggle="tooltip" title="Click to add image"
                                                        data-placement="bottom" src="assets/images/add-image-icon.jpg"
                                                        alt="Add Image">

                                                    <input name="image" type="file" onchange="changeImg(this);"
                                                        accept="image/x-png,image/gif,image/jpeg"
                                                        class="image form-control-file" style="display: none;">

                                                    <input type="hidden" name="product_id" value="">
                                                </div>
                                            </form>
                                        </li>
                                    </div>
                                </div>

                                <div class="position-relative row form-group mb-1">
                                    <div class="col-md-9 col-xl-8 offset-md-3">
                                        <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                            <span class="btn-icon-wrapper pr-2 opacity-8">
                                                <i class="fa fa-download fa-w-20"></i>
                                            </span>
                                            <span>Lưu</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif

    </div>
    <!-- End Main -->
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#li-trang-tinh').addClass('mm-active');
            $('#logo').addClass('mm-active');
        });
    </script>
@endsection
