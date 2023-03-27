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
                        {{ $binh_luan_san_pham->ten_san_pham }}
                        <div class="page-title-subheading">
                            {{ $binh_luan_san_pham->ten_loai_san_pham }}
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
                            <label for="" class="col-md-3 text-md-right col-form-label">Hình ảnh</label>
                            <div class="col-md-9 col-xl-8">
                                <div class="hinh-anh-binh-luan">
                                    @if ($hinh_binh_luan->count() != null)
                                        @foreach ($hinh_binh_luan as $key => $value)
                                            <img src="{{ URL($value->ten_file) }}" alt="tải hình ảnh" class="img-binh-luan">
                                        @endforeach
                                    @else
                                        <p>Đánh giá không có hình ảnh</p>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="brand_id" class="col-md-3 text-md-right col-form-label">tên người gửi</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $binh_luan_san_pham->ten }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Đánh giá</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $binh_luan_san_pham->danh_gia }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $binh_luan_san_pham->ten_san_pham }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="price" class="col-md-3 text-md-right col-form-label">Phân loại</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $binh_luan_san_pham->ten_loai_san_pham }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="content" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                            <div class="col-md-9 col-xl-8">
                                <p id=>{!! $binh_luan_san_pham->noi_dung == null ? 'Chưa có nội dung' : $binh_luan_san_pham->noi_dung !!}</p>
                            </div>
                        </div>

                    </div>
                    <div class="position-relative row form-group mb-1">
                        <div class="col-md-9 col-xl-8 offset-md-2">
                            <a href="{{ url()->previous() }}" class="border-0 btn btn-outline-danger mr-1">
                                <span class="btn-icon-wrapper pr-1 opacity-8">
                                    <i class="fa fa-times fa-w-20"></i>
                                </span>
                                <span>Trở lại</span>
                            </a>

                            <button class="btn-shadow btn-hover-shine btn btn-primary"
                                onclick="hien_form_tra_loi_binh_luan({{ $binh_luan_san_pham->id }})">
                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                    <i class="fa fa-reply fa-w-20"></i>
                                </span>
                                <span>Trả lời</span>
                            </button>
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
            $('#binh-luan-san-pham').addClass('mm-active');
            $('#li-san-pham').addClass('mm-active');
        });


        $(document).on('click', '.hinhanhsp', function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            var hinhanhsp = document.getElementById('hinhanhsp').files[0];
            //console.log(hinhanhsp);
            var formData = new FormData();
            formData.append('hinhanhsp', hinhanhsp);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    alert(data.mess);
                    location.reload();
                }
            });
        });

        function hien_form_tra_loi_binh_luan(id) {
             var form_danh_gia = document.getElementById("form-danh-gia");
            var url = "{{ route('admin.hien-form-tra-loi-binh-luan', '') }}" + '/' + id;
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(data) {
                  
                    form_danh_gia.style.display = "block";
                      add_them_layout();
                    $('#form-danh-gia').html("");
                    $('#form-danh-gia').append(data);
                }
            });
        }
    </script>
@endsection
