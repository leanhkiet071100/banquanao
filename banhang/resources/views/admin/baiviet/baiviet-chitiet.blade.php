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
                        Bài viết chi tiết
                        <div class="page-title-subheading">
                            {{$baiviet->tieu_de}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">
                        <div class="position-relative row form-group">
                            <label for="" class="col-md-3 text-md-right col-form-label">Hình</label>
                            <div class="col-md-9 col-xl-8">
                                <ul class="text-nowrap overflow-auto" id="images">
                                    <li class="d-inline-block mr-1" style="position: relative;">
                                        <img style="height: 150px;" src="{{URL($baiviet->hinh_anh)}}" alt="Image">
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="brand_id" class="col-md-3 text-md-right col-form-label">Loại bài viêt</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $baiviet->loai_bai_viet == null ? 'chưa có trọng lượng' : $baiviet->loai_bai_viet }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Người viết bài</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $baiviet->ten }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tiêu  đề</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $baiviet->tieu_de  }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="price" class="col-md-3 text-md-right col-form-label">Phụ đề</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $baiviet->phu_de ?? "không có phụ đề" }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="content" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                            <div class="col-md-9 col-xl-8">
                                <p id=>{!! $baiviet->noi_dung == null ? 'Chưa có nội dung' : $baiviet->noi_dung !!}</p>
                            </div>
                        </div>
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
    </script>
@endsection
