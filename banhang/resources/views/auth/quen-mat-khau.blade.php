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
                            <h4>Tìm tài khoản của bạn</h4>
                            <div class="line"></div>
                        </div>
                        @if ($errors->has('error'))
                            <div class="alert alert-danger">
                                {{ $errors->first('error') }}
                            </div>
                        @endif

                        <form action="{{ route('post-quen-mat-khau') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                    value="{{ old('email') ?? $email }}" placeholder="Vùi lòng nhập email">
                                <div class="text-center">
                                    @error('email')
                                        <span style="color:red"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group-register">
                                <div class="register">
                                    <p>Bạn chưa có tài khoản ư?</p><a href="{{ route('dang-ki') }}">Đăng kí</a>
                                </div>
                            </div>
                            <button type="submit" class="btn vizew-btn w-100 mt-30">Tìm kiếm</button>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

 @section('js')
     <script>
         $(document).ready(function() {
             $('#san-pham').removeClass('active');
             $('#home').removeClass('active');
         });
     </script>
 @endsection
