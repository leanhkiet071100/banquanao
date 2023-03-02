@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Breadcrumb Section Begin -->
    @include('layouts.banner')
    <!-- Breadcrumb Section End -->
    @if (session()->has('success'))
        <script>
            Swal.fire(
                '{{ session()->get('success') }}',
                '',
                'success'
            )
        </script>
    @endif
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gio_hang as $key => $value)
                                    <tr>

                                        <td class="shoping__cart__item">
                                            <img src="{{ URL($value->hinh_anh) }}" alt="">
                                            <h5>{{ $value->ten_san_pham }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ number_format(( $value->gia - $value->gia * ($value->tien_giam / 100)), 2, ',', '.') }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty" >
                                                    <span class="dec qtybtn" ma-san-pham="{{$value->id}}">-</span>
                                                    <input id="so-luong-san-pham{{$value->id}}" class="so-luong-san-pham" type="text" value="{{ $value->so_luong }}" ma-san-pham="{{$value->id}}" onchange="cap_nhat_so_luong_gio_hang({{$value->id}},$(this).val())">
                                                    <span class="inc qtybtn" ma-san-pham="{{$value->id}}">+</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total" id="shoping__cart__total{{$value->id}}">
                                            {{number_format(($value->gia - $value->gia * ($value->tien_giam / 100)) * $value->so_luong )}}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a onclick="return confirm('bạn có chắc muốn xoá ')"
                                                href="{{ route('gio-hang-xoa-san-pham', ['id' => $value->id]) }}"
                                                class="shoping_cart_item_close"> <span class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('san-pham') }}" class="primary-btn cart-btn">Tiếp tục mua đồ</a>
                        {{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Mã giảm giá</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">Áp dụng</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Tổng tiền giỏ hàng</h5>
                        <ul>
                            <li>Subtotal <span>$454.98</span></li>
                            <li>Total <span>$454.98</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#san-pham').removeClass('active');
            $('#home').removeClass('active');
        });
         
        /*-------------------
    		Quantity change
    	--------------------- */
        var proQty = $('.pro-qty');
        // proQty.prepend('<span class="dec qtybtn">-</span>');
        // proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on('click', '.qtybtn', function() {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            var ma_san_pham = $(this).attr('ma-san-pham');
            console.log(ma_san_pham);
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
                 
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            cap_nhat_so_luong_gio_hang(ma_san_pham, newVal);
            $button.parent().find('input').val(newVal);
         
        });
        
        function cap_nhat_so_luong_gio_hang(ma_san_pham, so_luong) {
            let url = "{{route('gio-hang-cap-nhat-so-luong')}}";
           
           var formData = new FormData();
            formData.append('ma_san_pham', ma_san_pham);
            formData.append('so_luong', so_luong);
       
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //window.location.reload(); load lại trang
                    //console.log(data.errors.hinhnhanhieu);
                    var gia = data.san_pham.gia;
                    var tien_giam = data.san_pham.tien_giam;
                    var tong_tien_san_pham = (gia - gia * (tien_giam / 100)) * so_luong;
                    $('#shoping__cart__total'+ ma_san_pham).html('');
                    $('#shoping__cart__total' + ma_san_pham).append(data.tong_tien_san_pham);
                    console.log(data.san_pham.gia);
                }
            });
        }

        
    </script>
@endsection
