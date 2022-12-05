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
                            @foreach ($lsloaisanpham as $key=>$value)
                                <li><a href="#">{{$value->ten_loai_san_pham}}</a></li>
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
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            @if ($shop != null)
                                <div class="hero__search__phone__text">
                                    <h5>{{$shop->so_dien_thoai}}</h5>
                                    <span>support 24/7 time</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="hero__item set-bg banner" id="banner" data-setbg="{{ URL ('assets/img/hero/banner.jpg')}}">
                        <div class="hero__text">
                         <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>