<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$shop->ten_shop}}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ URL('assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL('assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL('assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL('assets/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL('assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL('assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL('assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL('assets/css/style.css') }}" type="text/css">
    <script src="{{ URL('assets/js/sweetalert2.js') }}"></script>

    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Page Preloder -->
    <div id="prelod">
        {{-- <div class="loader"></div> --}}
        <div class="load"></div>
    </div>

    <!-- Humberger Begin  menu mobie-->
    @include('layouts/menumobie')
    <!-- Humberger End -->

    <!-- Header Section Begin  menu-->
    @include('layouts/menu')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    @include('layouts/timkiem')
    <!-- Hero Section End -->
    @section('sidebar')
    @show
     <!-- Footer Section Begin -->
    @include('layouts.footer-user')
        <!-- Footer Section End -->
    <!-- Js Plugins -->
    
    <script src="{{ URL('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ URL('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ URL('assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ URL('assets/js/mixitup.min.js') }}"></script>
    <script src="{{ URL('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL('assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $url = window.location.href;
            $('#nd-banner').html('');
            if ($url == "{{ Route('san-pham') }}") {
                 $('#nd-banner').append('<h2>Sản phẩm</h2>');
            } else if ($url == "{{ Route('bai-viet') }}") {
                 $('#nd-banner').append('<h2>Bài viết</h2>');
            } else if ($url == "{{ Route('gioi-thieu') }}") {
                 $('#nd-banner').append('<h2>Thông tin của shop</h2>');
            } else if ($url == "{{ Route('gio-hang') }}") {
                 $('#nd-banner').append('<h2>Giỏ hàng của bạn</h2>');
            } 
        });
    </script>
    @yield('js')
    @yield('js-menu-tai-khoan')



</body>

</html>
