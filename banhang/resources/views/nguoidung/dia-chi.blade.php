@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Main -->
    <section class="time-line-user">
        <div class="container">
            <div class="row">
                @include('layouts.menu-tai-khoan')
                <div class="col-lg-9 col-md-7 order-md-1 order-1 detail-info">
                    <div class="detail-info-menu">
                        <div class="detail-info-content">
                            <div class="detail-info-title row dia-chi">
                                <h4 class="title">Địa chỉ của tôi</h4>
                                <button class="btn-add-dia-chi"><i class="fa fa-plus-square"> Thêm địa chỉ mới</i></button>
                                {{-- <div class="slogan">Quản lí thông tin để bảo mật tài khoản</div> --}}
                            </div>
                            <div class="dia-chi-nguoi-dung">
                                <div class="chi-tiet-dia-chi row">
                                    <div class="dia-chi-thong-tin">
                                        <span class="span">
                                            <div class="ho-ten">Nguyễn Duy Đan Trinh</div>
                                        </span>
                                        <div class="duong-ke"></div>
                                        <div class="so-dien-thoai">0365688058</div>
                                    </div>
                                    <div class="btn-dia-chi">
                                        <button class="edit-dia-chi">Cập nhật</button>
                                    </div>

                                </div>
                                <div class="hien-dia-chi    ">
                                    <div class="show-dia-chi">
                                        <div class="show-dia-chi-full">
                                            Số 12 đương N14
                                        </div>
                                        <div class="tinh-huyen-xa">
                                            Xã Trung Hòa, Huyện Trảng Bom Tỉnh đồng Nai
                                        </div>
                                    </div>
                                    <div class="thiet-lap">
                                        <button class="btn-thiet-lap">Thiết lập mặc định</button>
                                    </div>
                                </div>
                                <div class="mac-dinh">
                                    <span>mặc định</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Main -->
@endsection

@section('js')
    <script type="text/javascript">
        $('#home').removeClass('active');

        $("#li-tai-khoan").on("click", "a", function() {
            var menu_tai_khoan = document.getElementById('menu-tai-khoan');
            if (menu_tai_khoan.style.display === "none") {
                menu_tai_khoan.style.display = "block";
            } else {
                menu_tai_khoan.style.display = "none";
            }
        });

        function changeImg(input) {
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e) {
                    //Thay đổi đường dẫn ảnh
                    $(input).siblings('.thumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        //Khi click #thumbnail thì cũng gọi sự kiện click #image
        $(document).ready(function() {
            $('.thumbnail').click(function() {
                $(this).siblings('.image').click();
            });
        });
    </script>

@endsection
