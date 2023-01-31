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
                            @foreach ($dia_chi as $key => $value)
                                <div class="dia-chi-nguoi-dung">
                                    <div class="chi-tiet-dia-chi row">
                                        <div class="dia-chi-thong-tin">
                                            <span class="span">
                                                <div class="ho-ten">{{ $value->ho_ten }}</div>
                                            </span>
                                            <div class="duong-ke"></div>
                                            <div class="so-dien-thoai">{{ $value->so_dien_thoai }}</div>
                                        </div>
                                        <div class="btn-dia-chi">
                                            <button class="edit-dia-chi"
                                                data-url={{ route('tai-khoan.get-dia-chi-sua', ['id' => $value->id]) }}>Cập
                                                nhật</button>
                                        </div>

                                    </div>
                                    <div class="hien-dia-chi    ">
                                        <div class="show-dia-chi">
                                            <div class="show-dia-chi-full">
                                                {{ $value->dia_chi_cu_the }}, {{ $value->tinh }}, {{ $value->huyen }},
                                                {{ $value->xa }}
                                            </div>
                                            {{-- <div class="tinh-huyen-xa">
                                                {{ $value->tinh }}, {{ $value->huyen }}, {{ $value->xa }}
                                            </div> --}}
                                        </div>
                                        @if ($value->mac_dinh != 1)
                                            <div class="thiet-lap">
                                                <button class="btn-thiet-lap" id-dia-chi="{{ $value->id }}">Thiết lập mặc
                                                    định</button>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($value->mac_dinh == 1)
                                        <div class="mac-dinh">
                                            <span>mặc định</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="form-dia-chi" id="form-dia-chi">

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End Main -->
@endsection


@section('js')
    <script type="text/javascript">
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

        $(".btn-add-dia-chi").click(function() {
            var url = "{{ route('tai-khoan.get-dia-chi') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'GET',
                //data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //console.log(data);
                    var form_dia_chi = document.getElementById('form-dia-chi');
                    form_dia_chi.style.display = "block";

                    var prelod = document.getElementById('prelod');
                    prelod.style.display = "block";
                    $('#form-dia-chi').html('');
                    $('#form-dia-chi').append(data);
                }
            });
        });

        $(".btn-thiet-lap").click(function() {
            var id_dia_chi = $(this).attr('id-dia-chi');
            var url = "{{ route('tai-khoan.thiet-lap-dia-chi') }}";
            var formData = new FormData();
            formData.append('id_dia_chi', id_dia_chi);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //console.log(data);
                    // alert(data.mess);
                    window.location.reload();

                }
            });
        });

        $(".edit-dia-chi").click(function() {
            var url = $(this).attr('data-url')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'GET',
                //data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //console.log(data);
                    var form_dia_chi = document.getElementById('form-dia-chi');
                    form_dia_chi.style.display = "block";
                    var prelod = document.getElementById('prelod');
                    prelod.style.display = "block";
                    $('#form-dia-chi').html('');
                    $('#form-dia-chi').append(data);
                }
            });
        })
    </script>

@endsection
