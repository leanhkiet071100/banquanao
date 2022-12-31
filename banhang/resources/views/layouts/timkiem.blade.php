 <section class="hero">
     <div class="container">
         <div class="row">
             <div class="col-lg-3">
                 <div class="hero__categories">
                     <div class="hero__categories__all">
                         <i class="fa fa-bars"></i>
                         <span>Loại sản phẩm</span>
                     </div>
                     <ul style="display:none" class="menu">
                         @foreach ($lsloaisanpham as $key => $value)
                             <li><a href="#">{{ $value->ten_loai_san_pham }}</a></li>
                         @endforeach


                     </ul>
                 </div>
             </div>
             <div class="col-lg-9">
                 <div class="hero__search">
                     <div class="hero__search__form">
                         <form action="#">
                             <div class="hero__search__categories">
                                 nhập tên sản phẩm
                                 <span class="arrow_carrot-down"></span>
                             </div>
                             <input type="text" placeholder="Bạn muốn tìm kiếm gì">
                             <button type="submit" class="site-btn">TÌM KIẾM</button>
                         </form>
                     </div>
                     @if ($shop != null)
                         @if ($shop->so_dien_thoai != null)
                             <div class="hero__search__phone">
                                 <div class="hero__search__phone__icon">
                                     <i class="fa fa-phone"></i>
                                 </div>

                                 <div class="hero__search__phone__text">
                                     <h5>{{ $shop->so_dien_thoai }}</h5>
                                     <span>Hỗ trợ 24/7</span>
                                 </div>

                             </div>
                         @endif

                     @endif
                 </div>
                 {{-- <div class="hero__item set-bg banner" id="banner" data-setbg="{{ URL ($hinh_anh->hinh_banner)}}">
                        <div class="hero__text">
                         <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>   
                        </div>
                    </div> --}}
                 {{-- sldieshow --}}

                 @if ($slideshownb->count() != null)


                     <div class="latest-product__text slideshow" id="slideshow">
                         <div class="latest-product__slider owl-carousel">
                             @foreach ($slideshownb as $key => $value)
                                 <div class="latest-slideshow__slider__item">
                                     <a href="{{ $value->link }}" class="latest-slideshow__item">
                                         <div class="carousel-item active">
                                             <img src="{{ URL($value->hinh_slideshow) }}" class="d-block w-100"
                                                 alt="{{ $value->tieu_de }}">
                                         </div>
                                     </a>
                                 </div>
                             @endforeach


                         </div>
                     </div>
                 @endif

                 {{-- end sldieshow --}}
             </div>
         </div>
 </section>
