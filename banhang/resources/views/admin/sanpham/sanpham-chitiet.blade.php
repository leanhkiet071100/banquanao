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
                        SẢN PHẨM
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
                    <div class="card-body display_data">
                        <div class="position-relative row form-group">
                            <label for="" class="col-md-3 text-md-right col-form-label">Hình ảnh</label>
                            <div class="col-md-9 col-xl-8">
                                <ul class="text-nowrap overflow-auto" id="images">
                                    <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                        <div style="width: 100%; max-height: 100%; overflow: hidden;"
                                            class="hinh-nhan-hieu">
                                            <img style="width: 100%; cursor: pointer; height:250px" class="thumbnail1"
                                                data-toggle="tooltip" title="Click to add image" data-placement="bottom"
                                                src="{{ URL($sanpham->hinh_anh) }}" alt="Add Image">

                                            <input name="hinhanhsp" type="file" onchange="changeImg(this);"
                                                id="hinhanhsp" accept="image/x-png,image/gif,image/jpeg" id="hinhnhanhieu"
                                                class="image form-control-file nhan-hieu-hinh" style="display: none;">
                                        </div>
                                    </li>
                                    <li id="hinh-anh-san-pham">
                                        <a onclick="huy()" class="border-0 btn btn-outline-danger mr-1">
                                            <span class="btn-icon-wrapper pr-1 opacity-8">
                                                <i class="fa fa-times fa-w-20"></i>
                                            </span>
                                            <span>Hủy</span>
                                        </a>
                                        <button class="hinhanhsp btn-shadow btn-hover-shine btn btn-primary"
                                            data-url="{{ route('admin.hinh-anh-san-pham', ['id' => $sanpham->id]) }}"
                                            onclick="">
                                            <span class="btn-icon-wrapper pr-2 opacity-8">
                                                <i class="fa fa-download fa-w-20"></i>
                                            </span>
                                            <span>Thêm</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="brand_id" class="col-md-3 text-md-right col-form-label">Danh sách hình ảnh</label>
                            <div class="col-md-9 col-xl-8">
                                <p><a href="{{ route('admin.chi-tiet-san-pham-hinh-anh', ['id' => $sanpham->id]) }}">Quản lí
                                        hình ảnh</a></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="brand_id" class="col-md-3 text-md-right col-form-label">Chi tiết</label>
                            <div class="col-md-9 col-xl-8">
                                <p><a href="{{ route('admin.chi-tiet-san-pham-ds', ['id' => $sanpham->id]) }}">quản lí chi tiết</a></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="brand_id" class="col-md-3 text-md-right col-form-label">Nhãn hiệu</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->ten_nhan_hieu }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Loại sản
                                phẩm</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->ten_loai_san_pham }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->ten_san_pham }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="price" class="col-md-3 text-md-right col-form-label">Giá</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->gia }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="discount" class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->tien_giam }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="qty" class="col-md-3 text-md-right col-form-label">Số lượng kho</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->so_luong_kho }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="weight" class="col-md-3 text-md-right col-form-label">Cân nặng</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->trong_luong == null ? 'chưa có trọng lượng' : $sanpham->trong_luong }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="sku" class="col-md-3 text-md-right col-form-label">SKU</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->SKU == null ? 'không có mã sku' : $sanpham->SKU }} </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="tag" class="col-md-3 text-md-right col-form-label">Tag</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $sanpham->tag == null ? 'không có tag' : $sanpham->tag }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="content" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                            <div class="col-md-9 col-xl-8">
                                <p id=>{!! $sanpham->noi_dung == null ? 'Chưa có nội dung' : $sanpham->noi_dung !!}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="description" class="col-md-3 text-md-right col-form-label">Mô tả</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{!! $sanpham->mo_ta == null ? 'Chưa có mô tả' : $sanpham->mo_ta !!}</p>
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
            $('#san-pham').addClass('mm-active');
            $('#li-san-pham').addClass('mm-active');
        });

        function changeImg(input) {
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if (input.files && input.files[0]) {
                var hinhanhsp = document.getElementById('hinh-anh-san-pham');
                hinhanhsp.style.display = "block";
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e) {
                    //Thay đổi đường dẫn ảnh
                    $(input).siblings('.thumbnail1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        //Khi click #thumbnail thì cũng gọi sự kiện click #image
        $(document).ready(function() {
            $('.thumbnail1').click(function() {
                $(this).siblings('.image').click();
            });
        });

        function huy() {
            location.reload();
        }

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
    </script>
@endsection
