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
                        <h2>BÀI VIẾT</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
               @include('baiviet.menubaiviet')

                @if ($lsbaiviet->count() != null)
                    <div class="col-lg-8 col-md-7">
                        <div class="row">
                            @foreach ($lsbaiviet as $key => $value)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__item">
                                        <div class="blog__item__pic">
                                            <img src="{{ URL($value->hinh_anh) }}" alt="">
                                        </div>
                                        <div class="blog__item__text">
                                            <ul>
                                                <li><i class="fa fa-calendar-o"></i>{{ $value->create_at }}</li>
                                                <li><i class="fa fa-comment-o"></i> 5</li>
                                            </ul>
                                            <h5><a href="#">{{ $value->tieu_de }}</a></h5>
                                            <p>{{ $value->phu_de }}</p>
                                            <a href="#" class="blog__btn">XEM THÊM <span
                                                    class="arrow_right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-lg-12">
                                <div class="product__pagination blog__pagination ds-bai-viet">
                                     {{ $lsbaiviet->appends(request()->all())->links('phantrang.phantrang') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="non-baiviet text-center col-lg-8 col-md-7 col-sm-6">
                        Không có bài viết
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!-- Blog Section End -->


@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#bai-viet').addClass('active');
            $('#home').removeClass('active');
        });
    </script>
@endsection

