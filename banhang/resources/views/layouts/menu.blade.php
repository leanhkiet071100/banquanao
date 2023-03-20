 <header class="header">
     <div class="header__top">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-6">
                     <div class="header__top__left">
                         <ul>
                             @if ($shop != null)
                                 @if ($shop->email != null)
                                     <li><i class="fa fa-envelope"></i>{{ $shop->email }} </li>
                                 @endif

                             @endif
                            @if ($slogan != null)
                                <li>{{$slogan->noi_dung}}</li>
                            @endif
                            
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-6">
                     <div class="header__top__right">
                        @if ($mang_xa_hoi->count() != null)
                            <div class="header__top__right__social">
                                @foreach ($mang_xa_hoi as $key=>$value )
                                    <a href="{{$value->link}}"><img src="{{URL($value->hinh_anh)}}" alt="" class="hinh-mang-xa-hoi"></a>
                                @endforeach
                            </div>
                         @endif
                         {{-- Ngôn ngữ --}}
                         {{-- <div class="header__top__right__language">
                                <img src="{{ URL ('assets/img/language.png')}}" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div> --}}
                         @if (Auth::user() != null)
                             <div class="header__top__right__auth">
                                 @if (Auth::user()->hinh_dai_dien != null)
                                     <a href="{{route('tai-khoan.tai-khoan')}}"> <img src="{{ URL(Auth::user()->hinh_dai_dien) }}"
                                             class="img-radius rounded-circle avatar"
                                             alt="User-Profile-Image">{{ Auth::user()->ten }}</a>
                                 @else
                                     <a href="{{route('tai-khoan.tai-khoan')}}"><i class="fa fa-user"></i>{{ Auth::user()->ten }}</a>
                                 @endif
                             </div>
                         @else
                             <div class="header__top__right__auth">
                                 <a href="{{ route('dang-nhap') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                             </div>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="container">
         <div class="row">
             <div class="col-lg-3">
                 @if ($shop != null)
                     @if ($shop->hinh_logo != null)
                         <div class="header__logo">
                             <a href="{{ route('index') }}"><img src="{{ URL($shop->hinh_logo) }}" alt=""></a>
                         </div>
                     @endif

                 @endif

             </div>
             <div class="col-lg-6">
                 <nav class="header__menu">
                     <ul>
                         <li class="active" id="home"><a href="{{ route('index') }}">Home</a></li>
                         <li id="san-pham"><a href="{{ route('san-pham') }}">Sản phẩm</a></li>
                         {{-- <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> --}}
                         <li id="bai-viet"><a href="{{ route('bai-viet') }}">Bài Viết</a></li>
                         <li id="gioi-thieu"><a href="{{ route('gioi-thieu') }}">Giới thiệu</a></li>
                     </ul>
                 </nav>
             </div>
             <div class="col-lg-3">
                 <div class="header__cart">
                     <ul>
                         {{-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> --}}
                         @if ($count != null)
                             <li id="gio-hang"><a href="{{ route('gio-hang') }}"><i class="fa fa-shopping-bag"></i>
                                     <span>{{ $count }}</span></a></li>
                         @else
                             <li id="gio-hang"><a href="{{ route('gio-hang') }}"><i class="fa fa-shopping-bag"></i> </a></li>
                         @endif

                     </ul>
                     {{-- <div class="header__cart__price">item: <span>$150.00</span></div> --}}
                 </div>
             </div>
         </div>
         <div class="humberger__open">
             <i class="fa fa-bars"></i>
         </div>
     </div>
 </header>
