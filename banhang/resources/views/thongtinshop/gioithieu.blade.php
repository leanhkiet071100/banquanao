@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Breadcrumb Section Begin -->
    @include('layouts.banner')
    <!-- Breadcrumb Section End -->
    @if ($shop != null)
        <!-- Contact Section Begin -->
        <section class="contact spad">
            <div class="container">
                <div class="row">
                    @if ($shop->so_dien_thoai)
                        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                            <div class="contact__widget">
                                <span class="icon_phone"></span>
                                <h4>Số điện thoại</h4>
                                <p>{{ $shop->so_dien_thoai }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($shop->dia_chi)
                        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                            <div class="contact__widget">
                                <span class="icon_pin_alt"></span>
                                <h4>Địa chỉ</h4>
                                <p>{{ $shop->dia_chi }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($shop->thoi_gian_mo && $shop->thoi_gian_dong)
                        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                            <div class="contact__widget">
                                <span class="icon_clock_alt"></span>
                                <h4>Thời gian mở cửa</h4>
                                <p>{{ date('H:i', strtotime($shop->thoi_gian_mo)) }} -
                                    {{ date('H:i', strtotime($shop->thoi_gian_dong)) }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($shop->email)
                        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                            <div class="contact__widget">
                                <span class="icon_mail_alt"></span>
                                <h4>Email</h4>
                                <p>{{ $shop->email }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- Contact Section End -->

        <!-- Map Begin -->
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
                height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            <div class="map-inside">
                <i class="icon_pin"></i>
                <div class="inside-widget">
                    <h4>New York</h4>
                    <ul>
                        <li>Phone: +12-345-6789</li>
                        <li>Add: 16 Creek Ave. Farmingdale, NY</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Map End -->
    @endif
    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>GIỬ PHẢN ÁNH</h2>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message"></textarea>
                        <button type="submit" class="site-btn">GỬI</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#gioi-thieu').addClass('active');
            $('#home').removeClass('active');
            // $('#nd-banner').append('<h2>Thông tin của shop</h2>');
        });
    </script>
@endsection
