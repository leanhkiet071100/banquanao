<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login | Admin - CodeLean eShop</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="CodeLean Design">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    @include('thuvien/cssadmin')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="app-logo-inverse mx-auto mb-3"></div>
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <form class="" action="{{ route('post-login-admin') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="h5 modal-title text-center">
                                            <h4 class="mt-2">
                                                <div>Chào mừng chở lại,</div>
                                                <span>Làm ơn điền vào ô sau đây</span>
                                            </h4>
                                        </div>
                                        @if ($errors->has('error'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('error') }}
                                            </div>
                                        @endif
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="email" id="exampleEmail" placeholder="Email"
                                                        type="email" class="form-control"
                                                        value="{{ old('email') ?? $email }}">
                                                </div>
                                                <div class="text-center">
                                                    @error('email')
                                                        <span style="color:red"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input id="examplePassword" placeholder="Mật khẩu" type="password"
                                                        class="form-control" name="mat-khau"
                                                        value="{{ old('mat-khau') ?? $mat_khau }}">
                                                </div>
                                                <div class="text-center">
                                                    @error('mat-khau')
                                                        <span style="color:red"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="position-relative form-check">
                                            <input name="remember" id="exampleCheck" type="checkbox"
                                                class="form-check-input">
                                            <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
                                        </div> --}}

                                    </div>
                                    <div class="modal-footer clearfix">
                                        <div class="float-right">
                                            <button class="btn btn-primary btn-lg" type="submit">Đăng nhập</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © CodeLean 2022</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('thuvien/jsadmin')
    @yield('js')
</body>

</html>
