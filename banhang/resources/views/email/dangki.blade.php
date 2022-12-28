<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('thuvien.cssadmin')
    <style>
        .email-dang-ki{
            padding: 30px;
        }
        .noi-dung-email {
            background: #f0f0f0;
            max-width: 600px;
            display: inline-block;
            font-family: Arial, 'Times New Roman', 'Calibri';
            text-align: center;
        }

        .hinh-logo img {
            width: 80px;
            height: 80px;
            border-radius: 100%;

        }

        .hinh-logo {
            align-items: center;

        }

        .noi-dung-email>div {
            justify-content: center;
        }

        .kich-hoat-tai-khoan {
            display: flex;
            justify-content: center;
            
        }

        .xac-nhan {
            background: #f9f9f9;
            background-size: cover;
            padding: 30px;
            display: grid;
        }

        .kich-hoat {
            margin: 10px;
            color: white;
            background-color: #7fad39;
            border-color: #7fad39;
            font-size: 1.8rem;
            font-weight: 500;
            display: inline-block;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            line-height: 1.5;
            border-radius: 0.25rem;
        }
        .kich-hoat:hover{
            color: #7fad39;
            background: black;
        }
    </style>
</head>

<body>
    {{-- <h2>hi {{$nguoidung->ten}}</h2>

    <a href="{{route('kich-hoat',['id'=>$nguoidung->id, 'token'=>$nguoidung->remember_token])}}">kích hoạt tài khoản</a> --}}
    <div>
        <div class="row email-dang-ki">
            <div class="main-card card ">
                <div class="card-body noi-dung-email" style="padding: 1.25rem">
                    <div class="position-relative row form-group hinh-logo">
                        <img src="{{ URL($hinh_anh->hinh_logo) }}" alt="">
                    </div>
                    <div class="position-relative row form-group">
                        <h1 class="welcome">Chào Mừng Tới Cửa Hàng với Chúng Tôi</h1>
                    </div>
                    <div class="position-relative row form-group kich-hoat-tai-khoan" style="justify-content: center">
                        <div class="xac-nhan">
                            <h2 class="loi-chao">Xin chào {{$nguoidung->ten}}</h2>
                            <p style="font-family: inherit; font-size: 20px;">Nếu bạn muốn tạo tài khoản, làm ơn kích hoạt tài khoản</p>
                            <a href="{{route('kich-hoat',['id'=>$nguoidung->id, 'token'=>$nguoidung->remember_token])}}" class="kich-hoat">Kích hoạt tài khoản</a>
                        </div>

                    </div>
                    <div class="position-relative row form-group  ">
                        <div class="thong-tin-them ">
                           Truy cập vào đường dẫn sau nếu bạn muốn xem sản phẩm, thông tin cửa hàng.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
