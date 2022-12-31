 @extends('layouts.layoutuser')

 @section('title', 'mạng xã hội')
 @section('sidebar')
     @parent

    @include('layouts.banner')
     <section class="product spad">
         <div class="container">
             <div class="row">
                 <div class="col-lg-3 col-md-5">
                     <div class="sidebar">
                         <div class="sidebar__item">
                             <h4>Loại san phẩm</h4>
                             <ul>
                                 @foreach ($lsloaisanpham as $key => $value)
                                     <li><a href="#">{{ $value->ten_loai_san_pham }}</a></li>
                                 @endforeach
                             </ul>
                         </div>
                         <div class="sidebar__item">
                             <h4>Price</h4>
                             <div class="price-range-wrap">
                                 <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                     data-min="10" data-max="540">
                                     <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                     <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                     <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                 </div>
                                 <div class="range-slider">
                                     <div class="price-input">
                                         <input type="text" id="minamount">
                                         <input type="text" id="maxamount">
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="sidebar__item sidebar__item__color--option">
                             <h4>Màu</h4>
                             @foreach ($lsmau as $key => $value)
                                 <div class="sidebar__item__size">
                                     <label for="large">
                                         {{ $value->mau }}
                                         <input type="radio" id="large">
                                     </label>
                                 </div>
                             @endforeach
                         </div>
                         <div class="sidebar__item">
                             <h4>Kích thước</h4>
                             @foreach ($lssize as $key => $value)
                                 <div class="sidebar__item__size">
                                     <label for="tiny">
                                         {{ $value->kich_thuoc }}
                                         <input type="radio" id="tiny">
                                     </label>
                                 </div>
                             @endforeach
                         </div>
                         <div class="sidebar__item">
                             <div class="latest-product__text">
                                 <h4>SẢN PHẨM MỚI</h4>
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
                 @if ($lssanpham->count() != null)
                     <div class="col-lg-9 col-md-7">
                         @if ($lssanphamsale->count() != null)
                             <div class="product__discount">
                                 <div class="section-title product__discount__title">
                                     <h2>Sale Off</h2>
                                 </div>
                                 <div class="row">
                                     <div class="product__discount__slider owl-carousel">
                                         @foreach ($lssanphamsale as $key => $value)
                                             <div class="col-lg-4">
                                                 <div class="product__discount__item">
                                                     <div class="product__discount__item__pic set-bg"
                                                         data-setbg="{{ URL($value->hinh_anh) }}">
                                                         <div class="product__discount__percent">-{{ $value->tien_giam }}%
                                                         </div>
                                                         <ul class="product__item__pic__hover">
                                                             <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                             <li><a href="{{route('chi-tiet-san-pham',['id'=>$value->id])}}"><i class="fa fa-retweet"></i></a></li>
                                                             <li><a href="#"><i class="fa fa-shopping-cart"></i></a>
                                                             </li>
                                                         </ul>
                                                     </div>
                                                     <div class="product__discount__item__text">
                                                         <h5><a href="{{route('chi-tiet-san-pham',['id'=>$value->id])}}">{{ $value->ten_san_pham }}</a></h5>
                                                         <div class="product__item__price">
                                                             {{ $value->gia - $value->gia * ($value->tien_giam / 100) }}<span>{{ $value->gia }}</span>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         @endforeach

                                     </div>
                                 </div>
                             </div>
                         @endif

                         <div class="filter__item">
                             <div class="row">
                                 <div class="col-lg-4 col-md-5">
                                     <div class="filter__sort">
                                         <span>Xếp theo</span>
                                         <select name="xeptheo" id="xeptheo">
                                             <option value="0">MặC định</option>
                                             <option value="1">Từ thấp đến cao</option>
                                             <option value="2">Từ cao đến thấp</option>
                                             <option value="3">Giám giá</option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-lg-4 col-md-4">
                                     <div class="filter__found">
                                         <h6><span>{{ $lssanpham->count() }}</span> Products found</h6>
                                     </div>
                                 </div>
                                 <div class="col-lg-4 col-md-3">
                                     <div class="filter__option">
                                         <span class="icon_grid-2x2"></span>
                                         <span class="icon_ul"></span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             @foreach ($lssanpham as $key => $value)
                                 {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                             <div class="product__item">
                                 <div class="product__item__pic set-bg" data-setbg="{{ URL($value->hinh_anh) }}">
                                     <div class="product__discount__percent">-{{ $value->tien_giam }}%</div>
                                     <ul class="product__item__pic__hover">
                                         <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                         <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                         <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                     </ul>
                                 </div>
                                 <div class="product__item__text">
                                     <h6><a href="#">{{$value->ten_san_pham}}</a></h6>
                                     @if ($value->tien_giam > 0)
                                         {{ $value->gia - $value->gia * ($value->tien_giam / 100) }}<span>{{ $value->gia }}</span>
                                     @else
                                        <h5>{{$value->gia}}</h5>
                                     @endif
                                     
                                 </div>
                             </div>
                         </div> --}}
                                 <div class="col-lg-4 col-md-6 col-sm-6">
                                     <div class="product__discount__item">
                                         <div class="product__discount__item__pic set-bg"
                                             data-setbg="{{ URL($value->hinh_anh) }}">
                                             @if ($value->tien_giam > 0)
                                                 <div class="product__discount__percent">-{{ $value->tien_giam }}%</div>
                                             @endif
                                             
                                             <ul class="product__item__pic__hover">
                                                 <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                 <li><a href="{{route('chi-tiet-san-pham',['id'=>$value->id])}}"><i class="fa fa-retweet"></i></a></li>
                                                 <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                             </ul>
                                         </div>
                                         <div class="product__discount__item__text">
                                             <h5><a href="{{route('chi-tiet-san-pham',['id'=>$value->id])}}">{{ $value->ten_san_pham }}</a></h5>
                                             @if ($value->tien_giam > 0)
                                            <div class="product__item__price">
                                                 {{ $value->gia - $value->gia * ($value->tien_giam / 100) }} đ<span>{{ $value->gia }}</span> 
                                             </div>
                                             @else
                                                  <h5 style="font-weight: bold">{{$value->gia}} đ</h5>
                                             @endif
                                             
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         </div>
                         <div class="product__pagination">
                             <a href="#">1</a>
                             <a href="#">2</a>
                             <a href="#">3</a>
                             <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                         </div>
                     </div>
                 @endif
             </div>
         </div>
     </section>
 @endsection

 @section('js')
     <script>
         $(document).ready(function() {
             $('#san-pham').addClass('active');
             $('#home').removeClass('active');
             //$('#nd-banner').html('');
             //$('#nd-banner').append('<h2>Sản phẩm</h2>');
             //$nd_banner.append('sản phẩm');
         });
         
     </script>
 @endsection
