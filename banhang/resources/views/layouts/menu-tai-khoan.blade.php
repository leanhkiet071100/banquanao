<div class="col-lg-2 col-md-3 order-md-1 order-2">
    <div class="info-user-full">

        <div class="info_user row">
            @if (Auth::user()->hinh_dai_dien != null)
                <a class="info-user-avatar" herf="">
                    <img src=" {{ URL(Auth::user()->hinh_dai_dien) }}" alt="không tải được">
                </a>
            @else
                <a class="info-user-avatar" herf="">
                    <img src=" {{ URL('hinh_test/avatar.png') }}" alt="không tải được">
                </a>
            @endif

            <div class="info">
                @if (Auth::user()->ten != null)
                    <div class="info-name text-center">
                        {{ Auth::user()->ten }}
                    </div>
                @endif
                <div class="info-edit">
                    <a href="{{ route('tai-khoan.tai-khoan') }}"><i class="fa fa-pencil fa-fw"></i>Sửa
                        thông tin</a>
                </div>
            </div>
        </div>

        <div class="info-menu app-sidebar sidebar-shadow">
            <div class="scrollbar-sidebar ps">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu metismenu">
                        <li class="" id="li-tai-khoan">
                            <a type="button">
                                <i class="fa fa-user"></i> Tài khoản của tôi
                                {{-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i> --}}
                            </a>
                            <ul class="mm-collapse mm-show menu-tai-khoan" id="menu-tai-khoan" style="display: none;">
                                <li>
                                    <a href="{{ route('tai-khoan.tai-khoan') }}" id="thong-tin-ca-nhan">
                                        <i class="metismenu-icon"></i>Thông tin cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('tai-khoan.dia-chi') }}" id="dia-chi">
                                        <i class="metismenu-icon"></i>Địa chỉ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ Route('tai-khoan.doi-mat-khau') }}" id="doi-mat-khau">
                                        <i class="metismenu-icon"></i>Đổi mật khẩu
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="" id="li-don-hang">
                            <a href="{{ Route('tai-khoan.don-hang') }}">
                                <i class="fa fa-credit-card"></i> Đơn hàng
                                {{-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i> --}}
                            </a>
                        </li>
                         <li class="" id="li-dang-xuat">
                            <a href="{{ Route('tai-khoan.logout-user') }}">
                                <i class="fa fa-window-close-o"></i> Đăng xuất
                                {{-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i> --}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js-menu-tai-khoan')
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
