@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Main -->
    @if (session()->has('success'))
        <script>
            alert('{{ session()->get('success') }}')
        </script>
    @endif
    <section class="time-line-user">
        <div class="container">
            <div class="row">
                @include('layouts.menu-tai-khoan')
                <div class="col-lg-10 col-md-9 order-md-1 order-1">
                    <div class="don-hang-box">
                        @include('layouts.menu-don-hang')
                    </div>
                    @foreach ($don_hang as $key => $value)
                        <div class="box-hoa-don">
                            <div class="don-hang-box">
                                <div class="detail-info-title info-title-don-hang">
                                    <h4 class="title">ĐƠN HÀNG</h4>
                                    <div class="trang-thai">
                                        @switch($value->trang_thai)
                                            @case(1)
                                                <span>Chờ xác nhận</span>
                                                @break
                                            @case(2)
                                                <span>Đang giao</span>
                                                @break
                                            @case(3)
                                                <span>Hoàn thành</span>
                                                @break
                                            @case(4)
                                                <span>Trả hàng</span>
                                                @break
                                            @case(0)
                                                <span>Hủy hàng</span>
                                                @break
                                            @default
                                                
                                        @endswitch
                                        
                                    </div>
                                </div>
                                @foreach ($don_hang_chi_tiet as $key2 => $value2)
                                    @if ($value2->ma_hoa_don == $value->id)
                                        <div class="list-product">
                                            <div class="detail-product">
                                                <div class="img-product">
                                                    <img src="{{ URL($value2->hinh_anh) }}" alt="">
                                                </div>
                                                <div class="info-product">
                                                    <div class="name-product">
                                                        <span>{{ $value2->ten_san_pham }}</span>

                                                    </div>
                                                    <div class="">
                                                        <span> x{{ $value2->so_luong }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="price-product">
                                                {{number_format( $value2->gia - $value2->gia * ($value2->tien_giam / 100),2,',','.') }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="chi-tiet-chuc-nang">
                                <div class="tong-tien">
                                    <div class="span-thanh-tien">
                                        <span>Thành tiền:</span>
                                    </div>
                                    <div class="span-tien">
                                        <span> {{number_format( $value->tien_hoa_don,2,',','.') }}</span>
                                    </div>
                                </div>
                                <div class="chuc-nang">
                                    <div class="danh-gia">
                                        <button class="btn-danh-gia">Đánh giá</button>
                                    </div>
                                    <div class="chi-tiet">
                                        <button class="btn-chi-tiet">Chi tiết</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Main -->
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#li-don-hang').addClass('tk-active');
            $('#home').removeClass('active');
            $('#cho-xac-nhan').addClass('active');
        });
       
    </script>

@endsection
