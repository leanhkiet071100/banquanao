@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent

    <!-- Categories Section Begin -->
    @if ($lsnhanhieu != null)
        <section class="categories">
            <div class="container">
                <div class="row">
                    <div class="categories__slider owl-carousel">
                        @foreach ($lsnhanhieu as $key => $value)
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="{{ URL($value->hinh_nhan_hieu) }}">
                                    <h5><a href="#">{{ $value->ten_nhan_hieu }}</a></h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Categories Section End -->
    @if ($lssanphamnb->count() != null)
        <!-- Featured Section Begin -->
        <section class="featured spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>SẢN PHẨM NỔI BẬT</h2>
                        </div>
                        <div class="featured__controls">
                            <ul>
                                <li class="active" data-filter="*">All</li>
                                @foreach ($lsloaisanphamnoibat as $key => $value)
                                    <li data-filter=".{{ $value->tag_loai_san_pham }}">{{ $value->ten_loai_san_pham }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row featured__filter">
                    @foreach ($lssanphamnb as $key => $value)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $value->tag_loai_san_pham }} ">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg" data-setbg="{{ URL($value->hinh_anh) }}">
                                    @if ($value->tien_giam > 0)
                                        <div class="product__discount__percent">-{{ $value->tien_giam }}%</div>
                                    @endif

                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="{{ route('chi-tiet-san-pham', ['id' => $value->id]) }}"><i
                                                    class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
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
        <!-- Featured Section End -->
    @endif
     <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ URL('assets/img/banner/banner-1.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ URL('assets/img/banner/banner-2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End --> 
    @if ($lssanphammoi->count() != null)


        <!-- Latest Product Section Begin -->
        <section class="latest-product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="latest-product__text">
                            <h4>SẢN PHẨM MỚI</h4>
                            <div class="latest-product__slider owl-carousel">
                                @foreach ($lssanphammoi as $key => $value)
                                    <div class="latest-prdouct__slider__item">

                                        <a href="{{ route('chi-tiet-san-pham', ['id' => $value->id]) }}"
                                            class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ URL($value->hinh_anh) }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $value->ten_san_pham }}</h6>
                                                <span>{{ $value->gia }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="latest-product__text">
                            <h4>TOP SẢN PHẨM</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-1.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-2.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-3.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-1.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-2.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-3.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="latest-product__text">
                            <h4>Sản phẩm tốt</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-1.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-2.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-3.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-1.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-2.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ URL('assets/img/latest-product/lp-3.jpg') }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Latest Product Section End -->
    @endif
    <!-- Blog Section Begin -->
    @if ($lsbaivietnb->count() != null)
        <section class="from-blog spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title from-blog__title">
                            <h2>Bài viết nổi bật</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($lsbaivietnb as $key => $value)
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ URL($value->hinh_anh) }}" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> {{ date("$value->created_at") }}</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a
                                            href="{{ route('chi-tiet-bai-viet', ['id' => $value->id]) }}">{{ $value->tieu_de }}</a>
                                    </h5>
                                    <p>{{ $value->phu_de }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title from-blog__title">
                            {{ $lsbaivietnb->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif
    <!-- Blog Section End -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#home').addClass('active');
            var slideshow = document.getElementById('slideshow');
            slideshow.style.display = "block";
        });
    </script>
@endsection
