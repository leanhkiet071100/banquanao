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
                                   
                                    <th class="shoping__product" width="60%">Sản phẩm</th>
                                    <th width="15%">Giá</th>
                                    <th width="10%">Số lượng</th>
                                    <th width="15%">Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                @foreach ($gio_hang as $key => $value)
                                    <tr id="tr-gio-hang{{$value->id}}">
                                       
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
                                                    <input onkeypress="return isNumberKey(event)" id="so-luong-san-pham{{$value->id}}" class="so-luong-san-pham" type="text" value="{{ $value->so_luong }}" ma-san-pham="{{$value->id}}" onchange="cap_nhat_so_luong_gio_hang({{$value->id}},$(this).val())" title="Số lượng cần mua">
                                                    <span class="inc qtybtn" ma-san-pham="{{$value->id}}">+</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total" id="shoping__cart__total{{$value->id}}">
                                            {{number_format(($value->gia - $value->gia * ($value->tien_giam / 100)) * $value->so_luong, 2, ',', '.' )}}
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
                @if($gio_hang->count()!=null)
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
                        <h5>Tổng tiền giỏ hàng <span>({{$count}} sản phẩm)</span></h5>
                        <ul>
                            <li>Tiền sản phẩm <span id="tong_tien_gio_hang">{{number_format($tong_tien_gio_hang,2, ',', '.')}}</span></li>
                            {{-- <li>Mã giảm giá <span>$454.98</span></li> --}}
                            {{-- <li>Tổng tiền <span>$454.98</span></li> --}}
                        </ul>
                        <a href="{{route('xuat-hoa-don')}}" class="primary-btn">THANH TOÁN</a>
                    </div>
                </div>
                @endif
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
            if(so_luong ==0){
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa sản phẩm này?',
                    text: "Khi xóa sẽ không còn sản phẩm trong giỏ hàng!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Chấp nhận'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                console.log(data);
                                Swal.fire(
                                    'Xóa thành công!',
                                    '',
                                    'success'
                                )
                                $('#tr-gio-hang' + ma_san_pham).html("");
                                $('#tong_tien_gio_hang').html('');
                                $('#tong_tien_gio_hang').append(data.tong_tien_gio_hang);
                                $('#gio-hang').html("");
                                $('#gio-hang').append('<li id="gio-hang"><a href="{{ route('gio-hang') }}"><i class="fa fa-shopping-bag"></i><span>' + data.count_gio_hang + '</span></a></li>');
                                //window.location.reload(); //load lại trang
                            }
                        });
                       
                    }else{
                      $('#so-luong-san-pham' + ma_san_pham).val(1);
                        cap_nhat_so_luong_gio_hang(ma_san_pham, 1)
                    }
                })
            }else{
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        //window.location.reload(); load lại trang
                        //console.log(data.errors.hinhnhanhieu);
                        if (data.status == 400) {
                            alert(data.errors.so_luong)
                        }else{
                        $('#shoping__cart__total'+ ma_san_pham).html('');
                        $('#shoping__cart__total' + ma_san_pham).append(data.tong_tien_san_pham);
                        $('#tong_tien_gio_hang').html('');
                        $('#tong_tien_gio_hang').append(data.tong_tien_gio_hang);
                        $('#gio-hang').html("");
                        $('#gio-hang').append('<li id="gio-hang"><a href="{{ route('gio-hang') }}"><i class="fa fa-shopping-bag"></i><span>' + data.count_gio_hang + '</span></a></li>');
                        }
                    }
                });
            }
        }

        function isNumberKey(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
@endsection
