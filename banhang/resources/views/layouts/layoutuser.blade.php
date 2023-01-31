<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

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
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        @if ($shop != null)
                            @if ($shop->hinh_logo != null)
                                <div class="footer__about__logo">
                                    <a href="./index.html"><img src="{{ URL($shop->hinh_logo) }}" alt=""></a>
                                </div>
                            @endif
                        @endif


                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i
                                    class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="{{ URL('assets/img/payment-item.png') }}"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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
