@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent

    <!-- banner -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ URL('assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $sanpham->ten_san_pham }}</h2>
                        <div class="breadcrumb__option">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Kết thúc banner -->

    <!-- sản phẩm ch tiết -->
    <form action="{{ route('them-gio-hang') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $sanpham->id }}" name="idsp">
        <section class="product-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item ">
                                <img class="product__details__pic__item--large" src="{{ URL($sanpham->hinh_anh) }}"
                                    alt="">
                            </div>
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach ($lshinhanh as $key => $value)
                                    <img data-imgbigurl="{{ URL($value->hinh_san_pham) }}"
                                        src="{{ URL($value->hinh_san_pham) }}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3>{{ $sanpham->ten_san_pham }}</h3>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(18 reviews)</span>
                            </div>

                            @if ($sanpham->tien_giam > 0)
                                <div class="product__details__price" name="gia">
                                    {{ number_format($sanpham->gia - $sanpham->gia * ($sanpham->tien_giam / 100), 2) }}đ
                                </div>
                            @else
                                <div class="product__details__price" name="gia">{{ number_format($sanpham->gia, 2) }}
                                </div>
                            @endif
                            @if ($sanpham->mo_ta != null)
                                <div class="noi-dung-san-pham">
                                    {!! $sanpham->mo_ta !!}
                                </div>
                            @endif

                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="number" value="{{ old('so_luong') ?? 1 }}" name="so_luong"
                                            min="1" max="100" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn">Thêm vào giỏ hàng</button>
                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                            <div class="text-center">
                                @error('so_luong')
                                    <span style="color:red"> {{ $message }}</span>
                                @enderror
                            </div>

                            <ul>
                                <li><b>Loại sản phẩm</b> <span>{{ $sanpham->ten_loai_san_pham }}</span></li>
                                {{-- <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li> --}}
                                <li><b>Cân nặng</b> <span>{{ $sanpham->trong_luong }} kg</span></li>
                                <li><b>Share on</b>
                                    <div class="share">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                </li>

                                <li><b>Màu</b>
                                    <div class="share">
                                        {{-- <button class="product-variation active">kiệt 1</button> --}}

                                    </div>
                                </li>

                                <li><b>size</b>
                                    <div class="share">

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                        aria-selected="true">thông tin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                        aria-selected="false">Mô
                                        tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                        aria-selected="false">Nội dung</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Thông ti sản phẩm</h6>
                                        <ul style="font-size: 30px">
                                            <li><b>Nhãn hiệu:</b> <span>{{ $sanpham->ten_nhan_hieu }}</span></li>
                                            <li><b>Loại sản phẩm:</b> <span>{{ $sanpham->ten_loai_san_pham }}</span></li>
                                            <li><b>Tên sản phẩm:</b> <span>{{ $sanpham->ten_san_pham }}</span></li>
                                            <li><b>Giá:</b>
                                                <span>{{ number_format($sanpham->gia - $sanpham->gia * ($sanpham->tien_giam / 100), 2) }}đ</span>
                                            </li>
                                            <li><b>Trọng lượng:</b> <span>{{ $sanpham->trong_luong }}</span></li>


                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h4>Mô tả sản phẩm</h4>
                                        <p>{!! $sanpham->mo_ta == null ? 'Chưa có mô tả' : $sanpham->mo_ta !!}</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Nội dung sản phẩm</h6>
                                        <p id=>{!! $sanpham->noi_dung == null ? 'Chưa có nội dung' : $sanpham->noi_dung !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    {{-- bình luận sản phẩm --}}
    <section class="rate-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Đánh giá sản phẩm</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="coment-area">
                    <ul class="we-comet">
                        <li>
                            @foreach ($ls_binh_luan as $key => $value)
                                @if ($value->hinh_dai_dien != null)
                                    <div class="comet-avatar">
                                        <img src="{{ URL($value->hinh_dai_dien) }}" alt="">
                                    </div>
                                @else
                                    <div class="comet-avatar">
                                        <img src="{{ URL('hinh_test/avatar.png') }}" alt="">
                                    </div>
                                @endif


                                <div class="we-comment">
                                    <div class="coment-head">
                                        <h5><span>{{ $value->ten }}</span></h5>
                                        <span>{{ date('d/m/Y', strtotime($value->created_at)) }}</span>
                                        <div class='rating-stars'>
                                            <ul id='stars-binh-luan' class="stars-binh-luan">
                                                <li class='star'>
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $value->danh_gia)
                                                            <i class='fa fa-star fa-fw sao-active'></i>
                                                        @else
                                                            <i class='fa fa-star fa-fw'></i>
                                                        @endif
                                                    @endfor
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p> {{ $value->noi_dung }}</p>
                                    <div class="hinh-anh-binh-luan">
                                        @foreach ($ls_binh_luan_hinh_anh as $key1 => $value1)
                                            @if ($value->id == $value1->ma_binh_luan)
                                                <img src="{{ URL($value1->ten_file) }}" alt=""
                                                    class="img-binh-luan">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <ul>
                                    @foreach ($ls_tra_loi as $key1 => $value1)
                                        @if ($value1->id_binh_luan_cha == $value->id)
                                            <li>
                                                @if ($value1->hinh_dai_dien != null)
                                                    <div class="comet-avatar">
                                                        <img src="{{ URL($value1->hinh_dai_dien) }}" alt="">
                                                    </div>
                                                @else
                                                    <div class="comet-avatar">
                                                        <img src="{{ URL('hinh_test/avatar.png') }}" alt="">
                                                    </div>
                                                @endif

                                                <div class="we-comment">
                                                    <div class="coment-head">
                                                        <h5><a href="time-line.html"
                                                                title="">{{ $value1->ten }}</a>
                                                        </h5>
                                                        <span>{{ date('d/m/Y', strtotime($value1->created_at)) }}</span>

                                                    </div>
                                                    <p>{{ $value1->noi_dung }}</p>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {{-- kết thúc bình luận sản phẩm --}}
    {{-- sản phẩm liên quan --}}
    @if ($lssanphamlienquan->count() != null)
        <section class="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title related__product__title">
                            <h2>Sản phẩm liên quan</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($lssanphamlienquan as $key => $value)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg"
                                    data-setbg="{{ URL($value->hinh_anh) }}">
                                    @if ($value->tien_giam > 0)
                                        <div class="product__discount__percent">-{{ $value->tien_giam }}%</div>
                                    @endif

                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="{{ route('chi-tiet-san-pham', ['id' => $value->id]) }}"><i
                                                    class="fa fa-retweet"></i></a></li>
                                        <li><a type="button" id="them-san-pham" class="them-san-pham"
                                                data-url="{{ route('gio-hang-them-san-pham', ['id' => $value->id]) }}"><i
                                                    class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <h5><a
                                            href="{{ route('chi-tiet-san-pham', ['id' => $value->id]) }}">{{ $value->ten_san_pham }}</a>
                                    </h5>
                                    @if ($value->tien_giam > 0)
                                        <div class="product__item__price">
                                            {{ $value->gia - $value->gia * ($value->tien_giam / 100) }}
                                            đ<span>{{ $value->gia }}</span>
                                        </div>
                                    @else
                                        <h5 style="font-weight: bold">{{ $value->gia }} đ</h5>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </section>
    @endif
    <!--Kết thúc sản phẩm liên quan -->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#san-pham').addClass('active');
            $('#home').removeClass('active');
        });
        $('.them-san-pham').click(function() {
            let url = $(this).attr('data-url');
            console.log(url);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                //data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //window.location.reload(); load lại trang
                    //console.log(data.errors.hinhnhanhieu);

                    if (data.status == 400) {
                        $('#error-tennhanhieu').html("");
                        $('#error-tennhanhieu').append(data.errors.tennhanhieu[0]);
                        $('#error-hinhnhanhieu').html("");
                        $('#error-hinhnhanhieu').append(data.errors.hinhnhanhieu[0]);
                        // $.each(data.errors, function(key, err_value){
                        //     $('#saveform_errList').append('<li style="color: red">'+err_value+'</li>');
                        // });
                        //console.log(data.error.tennhanhieu);
                    } else {
                        $('#gio-hang').html("");
                        $('#gio-hang').append(
                            '<li id="gio-hang"><a href="{{ route('gio-hang') }}"><i class="fa fa-shopping-bag"></i><span>' +
                            data.count_gio_hang + '</span></a></li>');
                        Swal.fire(
                            'Thêm sản phẩm thành công',
                            '',
                            'success'
                        )
                    }

                }
            });

        });
    </script>
@endsection
