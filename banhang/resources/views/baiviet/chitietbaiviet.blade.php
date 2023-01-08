@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{ URL('assets/img/blog/details/details-hero.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2 class="" style="color:white">{{ $baiviet->tieu_de }}</h2>

                        @if ($baiviet->phu_de != null)
                            <h2 style="font-size: 50px">{{ $baiviet->phu_de }}</h2>
                        @endif

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
                <input type="hidden" value="{{ $baiviet->id }}" id="id-bai-viet">
                {{-- @include('baiviet.menubaiviet') --}}
                <div class="col-lg-12 col-md-12 order-md-1 order-1">
                    <div class="blog__details__text">
                        {!! $baiviet->noi_dung !!}
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src=" {{ $baiviet->hinh_dai_dien != null ? URL($baiviet->hinh_dai_dien) : URL('hinh_test/no-img.jpg') }}"
                                            alt="hình avatar">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>{{ $baiviet->ten }}</h6>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Loại bài viết:</span> {{ $baiviet->loai_bai_viet }}</li>
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
    <!-- Kết thúc sản  phẩm  chi tiết -->
    <hr style="width:100%;text-align:left;margin-left:0">
    <div class="container">
        <div class="binhluan">
            <div class="post-comment avatar-binhluan">
                <div class="post-comt-box">
                    <div class="row">
                        <div class="coment-area">
                            <ul class="we-comet">
                                <li>
                                    <form action="" id="binh-luan-bai-viet" method="post"
                                        data-url="{{ route('binh-luan-bai-viet', ['id' => $baiviet->id]) }}">
                                        @csrf
                                        <div class="we-comment-binhluan">
                                            <textarea placeholder="Viết bình luận..." id="noidungbinhluan" name="noidungbinhluan" class="noidungbinhluan"></textarea>
                                            <div class="add-smiles">
                                                <div class="guibinhluan">
                                                    <button class="btnbinhluan" id="btnbinhluan" name="btnbinhluan"
                                                        onclick="">
                                                        <i class="fa fa-paper-plane"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- nhập bình luân --}}
    {{-- bình luân --}}
    <section class="rate-commment">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Bình luận bài viết</h2>
                    </div>
                </div>
            </div>
            <div class="" id="load-binh-luan">

            </div>
        </div>
    </section>
    {{-- kết thúc bình luận --}}

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bai-viet').addClass('active');
            $('#home').removeClass('active');
            load_binh_luan(1);
        });

        // $("#rep-binh-luan-bai-viet").submit(function(e) {
        //     e.preventDefault();
        //     alert("Kiệt");
        // });

        $("#binh-luan-bai-viet").submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            var noi_dung = $('#noidungbinhluan').val();

            var formData = new FormData();
            formData.append('noidung', noi_dung);
           
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
                    //load_binh_luan(1);
                    console.log(data);
                    if (data.status == 400) {
                        alert(data.errors.noidung[0])
                        
                    }else if (data.status == 401) {
                        alert(data.errors)
                    }else {
                        alert(data.mess);
                        $('#noidungbinhluan').val('');
                        load_binh_luan(1);
                    }
                }
            });
        });

        function rep_binh_luan_bai_viet(id_bai_viet, id_binh_luan, page) {
            var url = "{{ route('binh-luan-bai-viet', '') }}" + '/' + id_bai_viet;
            var noi_dung = $('#noidungbinhluan' + id_binh_luan).val();
            var formData = new FormData();
            formData.append('noidung', noi_dung);
            formData.append('id_binh_luan', id_binh_luan);

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
                    //load_binh_luan(1);
                    console.log(data);
                    if (data.status == 400) {
                        alert(data.errors.noidung[0])
                    } else {
                        alert(data.mess);
                        $('#noidungbinhluan').val('');
                        load_binh_luan(page);
                    }
                }
            });

        }

        function load_binh_luan(page) {
            var url = "{{ route('load-binh-luan-bai-viet') }}"
            var id_bai_viet = $('#id-bai-viet').val();
       
            var formData = new FormData();
            formData.append('idbaiviet', id_bai_viet);

            formData.append('page', page);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //window.location.reload(); load lại trang
                    //console.log(data);
                    $('#load-binh-luan').html('');
                    $('#load-binh-luan').append(data);
                    $('#page' + page).addClass('active-phan-trang');
                    // if (data.status == 400) {
                    //     $('#saveform_errList').html("");
                    //     $('#error-tennhanhieu').html("");
                    //     $('#error-tennhanhieu').append(data.errors.tennhanhieu[0]);
                    // } else {
                    //     alert(data.mess);
                    //     $('#table-dsnhanhieu').html('');
                    //     loadnhanhieu();
                    // }
                }
            });
        }

        function form_tra_loi_binh_luan(id_binh_luan) {
            var x = document.getElementById("rep-commment" + id_binh_luan);
            x.style.display = "block";

        }

        // $('.pagina   n a').unbind('click').on('click', function(e) {
        //     e.preventDefault();

        //     var page = $(this).attr('href').split('page=')[1];
        //     getPosts(page);
        // });

        // function getPosts(page) {
        //     $.ajax({
        //             type: "GET",
        //             url: '?page=' + page
        //         })
        //         .success(function(data) {
        //             $('body').html(data);
        //         });
        // }
    </script>
@endsection
