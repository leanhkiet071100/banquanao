@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
        <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{ URL('assets/img/blog/details/details-hero.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2 class="" style="color:white">{{$baiviet->tieu_de}}</h2>
                        
                        @if ($baiviet->phu_de!=null)
                            <h2 style="font-size: 50px">{{$baiviet->phu_de}}</h2>
                        @endif
                        <ul>
                            <li>{{$baiviet->ten}}</li>
                            <li>{{$baiviet->created_at}}</li>
                            <li>8 Comments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                @include('baiviet.menubaiviet')
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        {!!$baiviet->noi_dung!!}
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src=" {{$baiviet->hinh_dai_dien != null? URL($baiviet->hinh_dai_dien) : URL('hinh_test/no-img.jpg')}}" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>{{$baiviet->ten}}</h6>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Loại bài viết:</span> {{$baiviet->loai_bai_viet}}</li>
                                        {{-- <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li> --}}
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#bai-viet').addClass('active');
            $('#home').removeClass('active');
        });
    </script>
@endsection

