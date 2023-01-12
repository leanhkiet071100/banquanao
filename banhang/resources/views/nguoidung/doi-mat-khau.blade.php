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
                                <h4 class="title">Đổi mật khẩu</h4>
                                <div class="slogan">Để bảo mật vui lòng không chia sẻ mật khẩu cho người khác</div>
                            </div>

                            <form action="{{ route('tai-khoan.post-doi-mat-khau') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="position-relative row form-group content">
                                    <label for="color" class="col-md-3 text-md-right col-form-label">Mật khẩu</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="mat-khau" id="mat-khau" placeholder="Mật khẩu" type="text"
                                            class="form-control" value="{{ old('mat-khau') }}">
                                        <div class="text-center">
                                            @error('mat-khau')
                                                <span style="color:red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->mat_khau == null)
                                    <div class="position-relative row form-group ">
                                        <label for="color" class="col-md-3 text-md-right col-form-label">Xác nhận mật
                                            khẩu</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input required name="xac-nhan-mat-khau" id="xac-nhan-mat-khau"
                                                placeholder="Xác nhận mật khẩu" type="text" class="form-control"
                                                {{ old('xac-nhan-mat-khau') }}>
                                            <div class="text-center">
                                                @error('xac-nhan-mat-khau')
                                                    <span style="color:red"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group ">
                                        <label for="color" class="col-md-3 text-md-right col-form-label">Mã xác
                                            nhận</label>
                                        <div class="col-md-9 col-xl-5">
                                            <input required name="ma-xac-nhan" id="ma-xac-nhan" placeholder="Mã xác nhận"
                                                type="text" class="form-control" {{ old('ma-xac-nhan') }}>
                                            <div class="text-center">
                                                @error('ma-xac-nhan')
                                                    <span style="color:red"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="ma-xac-nhan col-md-3 col-xl-4">
                                            <button class="btn-ma-xac-nhan col-md-9 col-xl-8 text-md-center ">Gửi
                                                mã</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="position-relative row form-group ">
                                        <label for="color" class="col-md-3 text-md-right col-form-label">Mật khẩu
                                            mới</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input required name="mat-khau-moi" id="mat-khau-moi" placeholder="Mật khẩu mới"
                                                type="text" class="form-control" value='{{ old('mat-khau-moi') }}''>
                                            <div class="text-center">
                                                @error('mat-khau-moi')
                                                    <span style="color:red"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group ">
                                        <label for="color" class="col-md-3 text-md-right col-form-label">Xác nhân mật
                                            khẩu mới</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input required name="xac-nhan-mat-khau-moi" id="xac-nhan-mat-khau-moi"
                                                placeholder="Xác nhận mật khẩu mới" type="text" class="form-control"
                                                value='{{ old('xac-nhan-mat-khau-moi') }}'>
                                            <div class="text-center">
                                                @error('xac-nhan-mat-khau-moi')
                                                    <span style="color:red"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                @endif

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
    </script>

@endsection
