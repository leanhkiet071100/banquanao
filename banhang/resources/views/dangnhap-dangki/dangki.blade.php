@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent

    <!-- dăng nhập -->
    <div class="vizew-login-area section-padding-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="login-content">
                        <!-- Section Title -->
                        <div class="section-heading">
                            <h4>Đăng kí tài khoản</h4>
                            <div class="line"></div>
                        </div>

                        <form action="{{route('post-dang-ki')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" name="ho-ten"
                                    placeholder="Họ và tên">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" name="mat-khau"
                                    placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                    placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" name="sdt"
                                    placeholder="Số điện thoại">
                            </div>
                           
                            {{-- <div class="form-group">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                                </div>
                            </div> --}}
                            <div class="form-group-forgot-password">
                                <div class="forgot-password">
                                    <a href="">Quên mật khẩu</a>

                                </div>
                            </div>
                            <div class="form-group-register">
                                <div class="register">
                                    <p>Bạn đã có tài khoản?</p><a href="{{route('dang-nhap')}}">Đăng nhập</a>
                                </div>
                            </div>
                            <button type="submit" class="btn vizew-btn w-100 mt-30">Login</button>
                        </form>
                        <div class="login-social">
                            <div class="login-other">
                                <div class="ke"></div>
                                <div class="other">Đăng kí</div>
                                <div class="ke"></div>
                            </div>
                            <div class="longin-social col_4">
                                <button class="social">
                                    <div class="img-social">
                                        <img src="{{ URL('assets/img/social/face.png') }}" alt="">
                                    </div>
                                    <div>
                                        facebook
                                    </div>
                                </button>
                                 <button class="social">
                                    <div class="img-social">
                                        <img src="{{ URL('assets/img/social/goggle.jpg') }}" alt="">
                                    </div>
                                    <div>
                                        goggle
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script></script>
@endsection
