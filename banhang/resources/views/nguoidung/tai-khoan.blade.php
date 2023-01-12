@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Main -->
    @if (session()->has('success'))
        <script>
            alert('{{ session()->get('success') }}')
        </script>
    @endif
    <section class="time-line-user">
        <div class="container">
            <div class="row">
                @include('layouts.menu-tai-khoan')
                <div class="col-lg-9 col-md-7 order-md-1 order-1 detail-info">
                    <div class="detail-info-menu">
                        <div class="detail-info-content">
                            <div class="detail-info-title">
                                <h4 class="title">Hồ sơ của tôi</h4>
                                <div class="slogan">Quản lí thông tin để bảo mật tài khoản</div>
                            </div>
                            <form action="{{ route('tai-khoan.post-tai-khoan') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="position-relative row form-group content">
                                    <label for="" class="col-md-3 text-md-right col-form-label">Ảnh đại diện</label>
                                    <div class="col-md-9 col-xl-8">
                                        <ul class="text-nowrap overflow-auto" id="images">
                                            <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                                <div style="width: 100%; max-height: 100%; overflow: hidden;"
                                                    class="anh-dai-dien">
                                                    <img style="width: 100%; cursor: pointer; height:250px"
                                                        class="thumbnail" data-toggle="tooltip" title="Click to add image"
                                                        data-placement="bottom"
                                                        src="{{ Auth::user()->hinh_dai_dien != null ? old('anh-dai-dien') ?? URL(Auth::user()->hinh_dai_dien) : old('anh-dai-dien') ?? URL('hinh_test/avatar.png') }}"
                                                        alt="Add Image">

                                                    <input name="anh-dai-dien" type="file" onchange="changeImg(this);"
                                                        id="anh-dai-dien" accept="image/x-png,image/gif,image/jpeg"
                                                        id="anh-dai-dien" class="image form-control-file anh-dai-dien"
                                                        style="display: none;">
                                                </div>
                                                <div class="text-center">
                                                    @error('anh-dai-dien')
                                                        <span style="color:red"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="position-relative row form-group content">
                                    <label for="color" class="col-md-3 text-md-right col-form-label">Họ và tên</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="ho-ten" id="ho-ten" placeholder="Họ và tên" type="text"
                                            class="form-control" value="{{ old('ho-ten') ?? Auth::user()->ten }}">
                                        <div class="text-center">
                                            @error('ho-ten')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="color" class="col-md-3 text-md-right col-form-label">Email</label>
                                    @if (Auth::user()->email != null)
                                        <div for="color" class=" text-md-left col-form-label">
                                            {{ Auth::user()->email }}
                                        </div> {{-- <button class="thay-doi">Thay đổi</button>
                                         --}}
                                    @else
                                        <button class="thay-doi col-md-9 col-xl-8 text-md-left ">Thêm email</button>
                                    @endif
                                </div>


                                <div class="position-relative row form-group">
                                    <label for="color" class="col-md-3 text-md-right col-form-label">Số điện
                                        thoại</label>
                                    @if (Auth::user()->so_dien_thoai != null)
                                        <div for="color" class="col-md-9 col-xl-8 text-md-left col-form-label">
                                            l0306191038
                                        </div>
                                        <button class="thay-doi">Thay đổi</button>
                                    @else
                                        <button class="thay-doi text-md-left ">Thêm số điện thoại</button>
                                    @endif
                                </div>
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Lưu</span>
                                    </button>
                                </div>

                            </form>
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
