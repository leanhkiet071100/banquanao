@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ URL('assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Hóa đơn</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your
                        code
                    </h6>
                </div>
            </div> --}}
       
            <div class="checkout__form">
                <h4>CHI TIẾT THANH TOÁN</h4>
                <form action="{{route('thanh-toan-hoa-don')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>
                                        <input name="ho_ten" type="text" value="{{$dia_chi->ho_ten}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Thành phố/ tỉnh<span>*</span></p>
                                <input type="text" value="{{$dia_chi->tinh}}" readonly>
                            </div>

                            <div class="checkout__input">
                                <p>Quận/ Huyện<span>*</span></p>
                                <input type="text" value="{{$dia_chi->huyen}}" readonly>
                            </div>
                            <div class="checkout__input">
                                <p>Xã/ Phường<span>*</span></p>
                                <input type="text" value="{{$dia_chi->xa}}" readonly>
                            </div>
                            <div class="checkout__input">
                                <p>số nhà<span>*</span></p>
                                <input type="text" value="{{$dia_chi->dia_chi_cu_the}}" readonly>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ cụ thể<span>*</span></p>
                                <input name="dia-chi-cu-the" readonly type="text" value="{{$dia_chi->dia_chi_cu_the.", ".$dia_chi->xa.", ".$dia_chi->huyen.", ".$dia_chi->tinh}}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input name="so-dien-thoai" type="text" value="{{$dia_chi->so_dien_thoai}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span>*</span></p>
                                <textarea name="" id="" cols="100%" rows="10" placeholder="Ghi chú"></textarea>
                     
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Hóa đơn của bạn</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Tổng tiền</span></div>
                                <ul>
                                    @foreach ($gio_hang as $key=>$value )
                                         <li>{{$value->ten_san_pham}} <span>{{number_format(($value->gia - $value->gia * ($value->tien_giam / 100)) * $value->so_luong, 2, ',', '.' )}}</span></li>
                                    @endforeach
                                   
                                   
                                </ul>
                                <div class="checkout__order__subtotal">Tiền sản phẩm <span>{{$tong_tien_gio_hang}}</span></div>
                                <div class="checkout__order__total">Tiền hóa đơn <span name="tien_hoa_don">{{$tong_tien_gio_hang}}</span></div>
                                <input type="hidden" name="tien_hoa_don" value="{{$tong_tien_gio_hang}}">

                                {{-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                <p>Cảm ơn bạn đã lựa chọn sản phẩm của chúng tôi</p>
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                            </div>
                            <div class="checkout__order">
                                <button type="submit" class="site-btn">Thay đổi địa chỉ</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection

@section('js')
    <script>
        $('#san-pham').addClass('active');
        $('#home').removeClass('active');
    </script>
@endsection
